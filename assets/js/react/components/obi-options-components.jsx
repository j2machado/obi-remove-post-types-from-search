/**
 * React component for the plugin's options page.
 */
/*
const ObiOptionsComponent = () => {
	return (
		<div>
			<h1 id="obi-my-id">Obi Remove Post Types from Search</h1>
			<form onSubmit={ handleFormSubmit }>
				{/* Form fields go here }
			</form>
		</div>
	);
};

export default ObiOptionsComponent;
*/

/**
 * React component for the plugin's options page.
 */
/*
import React from './react';

class ObiOptionsComponent extends React.Component {
	constructor( props ) {
		super( props );
		this.state = {
			// Set initial state here.
		};
	}

	render() {
		return (
			<div className="obi-options">
				<h1>My Plugin Options</h1>
				{/* Add your options UI here }
			</div>
		);
	}
}

export default ObiOptionsComponent;
*/

/**
 * React component for the plugin's options page.
 */

import { createElement, Component } from 'wp.element';

class ObiOptionsComponent extends Component {
	constructor( props ) {
		super( props );
		this.state = {
			// Set initial state here.
		};
	}

	render() {
		return createElement(
			'div',
			{ className: 'obi-options' },
			createElement( 'h1', {}, 'My Plugin Options' ),
			// Add your options UI here
		);
	}
}

export default ObiOptionsComponent;
