import React from 'react';

class About extends React.Component {
    constructor(props) {
        super();
    }
    render() {
        return (
            <div>
                <div className='row'>
                    <div className="col-md-4">
                        <br />
                        <p className='alert alert-info'>About route</p>
                    </div>
                </div>
            </div>
        );
    }
}

export default About;