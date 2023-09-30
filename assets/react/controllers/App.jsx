import React from 'react';
import {Route, Router} from 'wouter';
import RecetteList from "../components/recette-list/RecetteList";

function App() {
    return (
        <div className="app">
            <Router>
                <Route path="/">
                    <RecetteList />
                </Route>
            </Router>
        </div>
    );
}

export default App;
