import {useState} from "react";
import NewMail from "./NewMail";

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
                <li className={activeTab === "tab1" ? "active" : ""} onClick={() => updateActiveTab('tab1')}>Send New Mail
                </li>
            </ul>
            <div className="outlet">
                <div className="outlet">
                    {activeTab === "tab1" ? <NewMail/> : ''}
                </div>
            </div>
        </div>
    );
};
export default Tabs;