import React from 'react';
import { connect } from 'react-redux';

import { searchUsers, getMe } from '../redux/actions';

class Api extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            query: ''
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleClick = this.handleClick.bind(this);
    }
    componentDidMount() {
        this.props.load();
    }
    handleChange(event) {
        this.setState({
            query: event.target.value
        });
    }
    handleClick() {
        this.props.search(this.state.query);
    }
    render() {
        const me = this.props.me;
        const users = this.props.users.map(user => {
            return (
                <User 
                    key={user.id}
                    username={user.username} 
                    email={user.email}>
                </User>
            )
        });
        return (
            <div>
                <div className='row'>
                    <div className="col-md-4">
                        <br />
                        <p className='alert alert-info'>You are: </p>
                        <ul className="list-group">
                            <User
                                key={me.id}
                                username={me.username}
                                email={me.email}>
                            </User>
                        </ul>
                    </div>
                </div>
                <div className='row'>
                    <div className="col-md-4">
                        <p className='alert alert-success'>Search users:</p>
                    </div>
                </div>
                <div className='row'>
                    <div className="col-md-3">
                        <input type="text"
                               onChange={this.handleChange}
                               className="form-control"
                               placeholder="Username" />
                    </div>
                    <div className="col-md-1">
                        <button onClick={this.handleClick}
                                className="form-control">
                            Search
                        </button>
                    </div>
                </div>
                <div className='row'>
                    <div className="col-md-4">
                        <br />
                        <ul className="list-group">
                            {users}
                        </ul>
                    </div>
                </div>
            </div>
        );  
    }
}

const User = (props) => {
    return (
        <li className="list-group-item">
            {props.username}
            <br />
            {props.email}
        </li>
    );
}

const mapStateToProps = state => {
    return {
        me: state.data.me,
        users: state.data.users
    }
};
const mapDispatchToProps = dispatch => {
    return {
        load: () => {
            dispatch(searchUsers(''));
            dispatch(getMe());
        },
        search: query => {
            dispatch(searchUsers(query));
        }
    }
};
export default connect(
    mapStateToProps, 
    mapDispatchToProps
)(Api);