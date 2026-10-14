/**
 * Front-end behaviour. Loaded deferred.
 *
 * Everything here is progressive: without script the page shows all
 * content, every room and a plain scrolling process row.
 */
( () => {
	const reduceMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	/* Header: a tone step once the page scrolls. */
	const header = document.querySelector( 'header.wp-block-template-part' );

	if ( header ) {
		const onScroll = () => header.classList.toggle( 'is-scrolled', window.scrollY > 8 );

		onScroll();
		window.addEventListener( 'scroll', onScroll, { passive: true } );

		// Sticky elements sit below the header: share its height with CSS.
		const setHeaderHeight = () =>
			document.documentElement.style.setProperty( '--itw-header-h', `${ Math.round( header.getBoundingClientRect().height ) }px` );

		setHeaderHeight();
		if ( 'ResizeObserver' in window ) {
			new ResizeObserver( setHeaderHeight ).observe( header );
		}
	}

	/* Hero: the room strip opens like a shutter. */
	document.querySelectorAll( '.h-hero' ).forEach( ( hero ) => hero.classList.add( 'is-live' ) );

	/* Process: back / forward buttons and a progress bar for the row. */
	document.querySelectorAll( '.h-process' ).forEach( ( section ) => {
		const row = section.querySelector( '.h-row' );
		const head = section.querySelector( '.h-process__head' );

		if ( ! row || ! head ) {
			return;
		}

		const nav = document.createElement( 'div' );
		nav.className = 'h-nav';
		nav.innerHTML = '<button type="button" aria-label="Previous step">←</button><button type="button" aria-label="Next step">→</button>';
		head.append( nav );

		const progress = document.createElement( 'div' );
		progress.className = 'h-progress';
		progress.setAttribute( 'aria-hidden', 'true' );
		progress.innerHTML = '<span></span>';
		head.after( progress );

		const step = () => ( row.querySelector( 'li' )?.getBoundingClientRect().width || 300 ) + 24;
		const [ prev, next ] = nav.querySelectorAll( 'button' );
		prev.addEventListener( 'click', () => row.scrollBy( { left: -step(), behavior: reduceMotion ? 'auto' : 'smooth' } ) );
		next.addEventListener( 'click', () => row.scrollBy( { left: step(), behavior: reduceMotion ? 'auto' : 'smooth' } ) );

		const update = () => {
			const max = row.scrollWidth - row.clientWidth;
			const seen = max > 0 ? ( row.scrollLeft + row.clientWidth ) / row.scrollWidth : 1;
			progress.style.setProperty( '--p', seen.toFixed( 3 ) );
			prev.disabled = row.scrollLeft < 4;
			next.disabled = row.scrollLeft > max - 4;
		};

		update();
		row.addEventListener( 'scroll', update, { passive: true } );
		window.addEventListener( 'resize', update );
	} );

	/* Panorama: a slow drift as it passes through the screen. */
	const pano = document.querySelector( '.h-intro__pano img' );

	if ( pano && ! reduceMotion ) {
		let ticking = false;
		const drift = () => {
			const rect = pano.parentElement.getBoundingClientRect();
			const progress = ( rect.top + rect.height ) / ( window.innerHeight + rect.height );
			pano.style.setProperty( '--drift', `${ ( ( progress - 0.5 ) * 6 ).toFixed( 2 ) }%` );
			ticking = false;
		};

		drift();
		window.addEventListener( 'scroll', () => {
			if ( ! ticking ) {
				ticking = true;
				requestAnimationFrame( drift );
			}
		}, { passive: true } );
	}

	/*
	 * Consultation form: until a form plugin handles submissions, write the
	 * visitor's answers into a WhatsApp or email message for them to send.
	 * Without script the form falls back to its mailto: action.
	 */
	document.querySelectorAll( '.c-form' ).forEach( ( form ) => {
		form.noValidate = true; // Script takes over validation with inline hints.

		const note = form.querySelector( '.c-form__note' );
		const labels = {
			name: 'Name',
			phone: 'Phone / WhatsApp',
			email: 'Email',
			project_type: 'Project',
			property: 'Property',
			city: 'City',
			area: 'Area (m²)',
			budget: 'Budget',
			style: 'Style',
			timeline: 'Start',
			message: 'About the room',
		};

		const markInvalid = () => {
			form.querySelectorAll( '.is-invalid' ).forEach( ( el ) => el.classList.remove( 'is-invalid' ) );
			const invalid = [ ...form.querySelectorAll( 'input, select, textarea' ) ].filter( ( el ) => ! el.checkValidity() );
			invalid.forEach( ( el ) => el.closest( '.c-field, .c-choice, .c-consent' )?.classList.add( 'is-invalid' ) );
			return invalid;
		};

		form.addEventListener( 'change', ( event ) => event.target.closest( '.is-invalid' )?.classList.remove( 'is-invalid' ) );

		form.addEventListener( 'submit', ( event ) => {
			event.preventDefault();

			const invalid = markInvalid();

			if ( invalid.length ) {
				note.textContent = 'Please fill in the highlighted fields.';
				invalid[ 0 ].focus();
				return;
			}

			const data = new FormData( form );
			const lines = Object.entries( labels )
				.map( ( [ key, label ] ) => [ label, ( data.get( key ) || '' ).toString().trim() ] )
				.filter( ( [ , value ] ) => value )
				.map( ( [ label, value ] ) => `${ label }: ${ value }` );
			const body = `Hello itw-corp, I would like to book a design consultation.\n\n${ lines.join( '\n' ) }`;
			const via = event.submitter?.value || 'whatsapp';

			const url = via === 'email'
				? `mailto:${ form.dataset.mail }?subject=${ encodeURIComponent( 'Consultation request' ) }&body=${ encodeURIComponent( body ) }`
				: `https://wa.me/${ form.dataset.wa }?text=${ encodeURIComponent( body ) }`;

			note.textContent = via === 'email'
				? 'Your email app is opening with the message ready to send.'
				: 'WhatsApp is opening with your message ready to send.';

			if ( via === 'email' ) {
				window.location.href = url;
			} else {
				window.open( url, '_blank', 'noopener' );
			}
		} );
	} );

	/*
	 * Portfolio: filters and "Load more" without a page reload. Both are
	 * ordinary links and a GET form underneath, so they work without script.
	 */
	const portfolio = document.querySelector( '.p-list' );
	const filter = document.querySelector( '.p-filter' );

	if ( portfolio && 'fetch' in window && 'DOMParser' in window ) {
		portfolio.classList.add( 'is-live' );

		const load = async ( url ) => {
			const response = await fetch( url, { credentials: 'same-origin' } );
			return new DOMParser().parseFromString( await response.text(), 'text/html' );
		};

		const markSet = () => filter?.querySelectorAll( 'select' ).forEach( ( s ) => s.classList.toggle( 'is-set', !! s.value ) );

		const show = async ( url, push = true ) => {
			portfolio.classList.add( 'is-loading' );
			try {
				const doc = await load( url );
				const next = doc.querySelector( '.p-list' );
				if ( next ) {
					portfolio.innerHTML = next.innerHTML;
					if ( push ) {
						history.pushState( { portfolio: true }, '', url );
					}
				}
			} catch ( e ) {
				window.location.href = url;
			} finally {
				portfolio.classList.remove( 'is-loading' );
			}
		};

		if ( filter ) {
			filter.classList.add( 'is-live' );
			markSet();
			filter.addEventListener( 'change', () => {
				const params = new URLSearchParams();
				new FormData( filter ).forEach( ( value, key ) => value && params.append( key, value ) );
				const url = filter.action + ( params.toString() ? `?${ params }` : '' );
				markSet();
				show( url );
			} );
			filter.addEventListener( 'submit', ( event ) => event.preventDefault() );
		}

		window.addEventListener( 'popstate', () => {
			const params = new URLSearchParams( window.location.search );
			filter?.querySelectorAll( 'select' ).forEach( ( s ) => ( s.value = params.get( s.name ) || '' ) );
			markSet();
			show( window.location.href, false );
		} );

		// "Load more": append the next page instead of replacing this one.
		portfolio.addEventListener( 'click', async ( event ) => {
			const link = event.target.closest( '.wp-block-query-pagination-next' );

			if ( ! link ) {
				return;
			}

			event.preventDefault();
			portfolio.classList.add( 'is-loading' );

			try {
				const doc = await load( link.href );
				const grid = portfolio.querySelector( '.p-grid' );
				doc.querySelectorAll( '.p-list .p-grid > li' ).forEach( ( item ) => grid.append( document.adoptNode( item ) ) );
				const more = portfolio.querySelector( '.p-more' );
				const nextMore = doc.querySelector( '.p-list .p-more' );
				if ( more ) {
					more.replaceWith( nextMore ? document.adoptNode( nextMore ) : document.createTextNode( '' ) );
				}
			} catch ( e ) {
				window.location.href = link.href;
			} finally {
				portfolio.classList.remove( 'is-loading' );
			}
		} );
	}

	/* Process: highlight the step being read in the sticky list. */
	const stepLinks = [ ...document.querySelectorAll( '.pr-index a[href^="#"]' ) ];

	if ( stepLinks.length && 'IntersectionObserver' in window ) {
		const byId = new Map( stepLinks.map( ( a ) => [ a.getAttribute( 'href' ).slice( 1 ), a ] ) );
		const stepObserver = new IntersectionObserver(
			( entries ) => {
				entries.forEach( ( entry ) => {
					if ( entry.isIntersecting ) {
						stepLinks.forEach( ( a ) => a.classList.remove( 'is-active' ) );
						byId.get( entry.target.id )?.classList.add( 'is-active' );
					}
				} );
			},
			{ rootMargin: '-45% 0px -50% 0px' }
		);

		byId.forEach( ( _, id ) => {
			const step = document.getElementById( id );
			if ( step ) {
				stepObserver.observe( step );
			}
		} );
	}

	/* Articles: "Copy link" share button. */
	document.querySelectorAll( '.b-share__copy' ).forEach( ( button ) => {
		button.addEventListener( 'click', async () => {
			const label = button.textContent;
			try {
				await navigator.clipboard.writeText( button.dataset.url );
				button.textContent = 'Link copied';
			} catch ( e ) {
				window.prompt( 'Copy this link:', button.dataset.url );
			}
			setTimeout( () => ( button.textContent = label ), 2000 );
		} );
	} );

	/* Entrances: heading, then text, then picture, as each section arrives. */
	if ( ! ( 'IntersectionObserver' in window ) ) {
		return;
	}

	const groups = document.querySelectorAll( '.itw-home .h-sec, .itw-home .h-quote, .itw-home .h-stats, .itw-home .h-cta, .site-footer' );
	const parts = ':is(h2, h3, p, li, figure, blockquote, .h-m)';

	const observer = new IntersectionObserver(
		( entries ) => {
			entries.forEach( ( entry ) => {
				if ( entry.isIntersecting ) {
					entry.target.classList.add( 'is-in' );
					observer.unobserve( entry.target );
				}
			} );
		},
		{ rootMargin: '0px 0px -6% 0px' }
	);

	groups.forEach( ( group ) => {
		let order = 0;
		let lastTop = null;

		group.querySelectorAll( parts ).forEach( ( el ) => {
			// Only animate outer parts: skip anything inside another animated part.
			const outer = el.parentElement.closest( parts );

			if ( outer && group.contains( outer ) ) {
				return;
			}

			// Background photographs stay put; only content enters.
			if ( el.matches( '.h-quote__photo, .h-stats__photo' ) ) {
				return;
			}

			const top = Math.round( el.getBoundingClientRect().top );
			order = lastTop !== null && Math.abs( top - lastTop ) > 400 ? 0 : order;
			lastTop = top;

			el.classList.add( 'rv' );
			el.style.setProperty( '--rv-delay', `${ Math.min( order, 6 ) * 70 }ms` );
			order += 1;
			observer.observe( el );
		} );
	} );
} )();
