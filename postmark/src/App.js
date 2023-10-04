import React, {useEffect, useState} from 'react';
import Tabs from "./components/Tabs";

import WPDataContext from "./components/Context/WPDataContext";

const App = () => {

    const [myPluginData, setMyPluginData] = useState({})

    return (
        <WPDataContext.Provider value={myPluginData}>
            <div>
                <h2 className='app-title'>My App</h2>
                <Tabs></Tabs>
                <hr/>
            </div>
        </WPDataContext.Provider>
    );
}

export default App;