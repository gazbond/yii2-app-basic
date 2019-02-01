import React from 'react';
import { Route, Link, withRouter } from 'react-router-dom';

import cookies from 'browser-cookies';
import axios from 'axios';

import Error from  './routes/Error';
import Home from './routes/Home';
import About from  './routes/About';
import Api from  './routes/Api';

class App extends React.Component {
    constructor(props) {
        super(props);
        
        // Get auth header from cookie and set as default
        const auth = cookies.get('Authorization');
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + auth;

        // Redirect to login if http 401 or /error if anything else
        axios.interceptors.response.use(
            response => response,
            error => {
                if (error.response.status === 401) {
                    // Encoded # (hash) - %23
                    window.location = '/user/login?returnUrl=/site/react%23' + this.props.location.pathname;
                } else {
                    this.props.history.push({
                        pathname: '/error',
                        state: {
                            error: error
                        }
                    });
                }
                return Promise.reject(error);
            }
        );
    }
    render() {
        return (
            <div>
                <ul className='nav nav-tabs'>
                    <li className={this.routeClassName('/')}>
                        <Link to="/">Home</Link>
                    </li>
                    <li className={this.routeClassName('/about')}>
                        <Link to='/about'>About</Link>
                    </li>
                    <li className={this.routeClassName('/api')}>
                        <Link to='/api'>Api</Link>
                    </li>
                </ul>
                <Route exact path='/error' component={Error} />
                <Route exact path='/' component={Home} />
                <Route exact path='/about' component={About} />
                <Route exact path='/api' component={Api} />
            </div>
        );
    }
    routeClassName(route) {
        return this.props.location.pathname === route ? 'active' : '';
    }

}

export default withRouter(App);