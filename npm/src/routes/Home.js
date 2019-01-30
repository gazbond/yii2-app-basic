import React from 'react';

class Home extends React.Component {
    constructor(props) {
        super();
    }
    render() {
        return (
            <div>
                <div className='row'>
                    <div className="col-md-4">
                        <br />
                        <p className='alert alert-info'>Home route</p>
                    </div>
                </div>
            </div>
        );
    }
}

export default Home;