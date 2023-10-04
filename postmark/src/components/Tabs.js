import Bounces from "./Bounces";
import {useState} from "react";
import Settings from "./Settings";

const Tabs = () => {
    const [activeTab, setActiveTab] = useState("tab1");

    const updateActiveTab = (tab) => {
        // update the state to tab1
        setActiveTab(tab);
    };

    return (
        <div className="Tabs">
            {/* Tab nav */}
            <ul className="nav">
                <li className={activeTab === "tab1" ? "active" : ""} onClick={() => updateActiveTab('tab1')}>Settings
                </li>
                <li className={activeTab === "tab2" ? "active" : ""} onClick={() => updateActiveTab('tab2')}>Bounces
                </li>
            </ul>
            <div className="outlet">
                <div className="outlet">
                    {activeTab === "tab1" ? <Settings/> : ''}
                    {activeTab === "tab2" ? <Bounces/> : ''}
                </div>
            </div>
        </div>
    );
};
export default Tabs;