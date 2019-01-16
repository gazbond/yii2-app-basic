/**
 * Created by gazbond on 04/01/2019.
 */
import React from 'react';

import { Route, Link } from 'react-router-dom';

import Home from './routes/Home';
import About from  './routes/About';

class App extends React.Component {
    constructor(props) {
        super();
    }
    render() {
        return (
            <div>

                <ul className="nav nav-tabs">
                    <li className={location.hash === '#/' ? 'active' : ''}>
                        <Link to="/" >Home</Link>
                    </li>
                    <li className={location.hash === '#/about' ? 'active' : ''}>
                        <Link to="/about">About</Link>
                    </li>
                </ul>
                <Route exact path="/" component={Home} />
                <Route exact path="/about" component={About} />
            </div>
        );
    }
}

export default App;