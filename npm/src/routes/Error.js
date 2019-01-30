import React from 'react';

export default class Error extends React.Component {
    constructor(props) {
        super(props);

        // Default message if accessed directly
        this.message = '';

        // Get error object after history.push() with state
        if(this.props.location.state) {
            this.message = this.props.location.state.error.message;
        } else {
            // Redirect to / if accessed directly
            // this.props.history.push('/');
        }

    }
    render() {
        return (
            <div className='alert alert-danger'>
                <p>{this.message}</p>
            </div>
        );
    }
}