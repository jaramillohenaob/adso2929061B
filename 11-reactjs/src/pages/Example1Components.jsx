import Btnback from '../components/BtnBack';

// Components Bulbasaur
function Bulbasaur() {
    return (
        <div style={{ border: '4px solid green',color: 'black', padding: '1.4rem', backgroundColor: '#9bbd94', width: '360px', borderRadius: '0.4rem'  }}>
            <h2>🌿Bulbasaur</h2>
            <h5>Type: Grass</h5>
            <h5>Attack: Razor Leaf</h5>
        </div>
    );
}

// Components Charmander
function Charmander() {
    return (
        <div style={{ border: '4px solid orange',color: 'black', padding: '1.4rem', backgroundColor: '#f0c080', width: '360px', borderRadius: '0.4rem'  }}>
            <h2>🔥Charmander</h2>
            <h5>Type: Fire</h5>
            <h5>Attack: Ember</h5>
        </div>
    );
}

// Components Squirtle
function Squirtle() {
    return (
        <div style={{ border: '4px solid lightblue',color: 'black', padding: '1.4rem', backgroundColor: '#e6f3ff', width: '360px', borderRadius: '0.4rem' }}>
            <h2>💧Squirtle</h2>
            <h5>Type: Water</h5>
            <h5>Attack: Hydro Pump</h5>
        </div>
    );
}

function Example1Components() {
    return (
        <div className="container">
            <Btnback />
            <h2>Example1Components</h2>
            <p>Create independent a reusable UI pieces.</p>
            <div style={{ display: 'flex', 
                          flexwrap: 'wrap',
                          gap: '1rem',
                          marginTop: '2rem',
                          justifyContent: 'center',
                          alignItems: 'center',
                          marginBottom: '2rem'
                             }}>
                <Bulbasaur />
                <Charmander />
                <Squirtle />
            </div>
        </div>
    );
}


export default Example1Components;