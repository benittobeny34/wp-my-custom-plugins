import React, {useEffect, useState, useContext} from "react";
import axios from 'axios';


import WpDataContext from "./Context/WPDataContext";

const Settings = () => {

        const [data, setData] = useState({
            token: '',
            user_name: '',
            password: '',
            site_url: '',
        })

        const nonce = document.getElementById('_wp_post_mark_nonce').value;

        console.log(nonce);


        const [loading, setLoading] = useState(true)

        const wpData = useContext(WpDataContext);

        const saveChanges = (e) => {
            e.preventDefault();

            if (!data.token && !data.user_name && !data.password) {
                alert('please fill all these fields');
                return
            }

            let fields = new FormData();

            fields.append('method', 'save_post_mark_settings');
            fields.append('action', 'auth_ajax');
            fields.append('token', data.token);
            fields.append('user_name', data.user_name);
            fields.append('password', data.password);
            fields.append('site_url', data.site_url);
            fields.append('_wp_nonce', nonce);

            axios.post('/wp-admin/admin-ajax.php', fields).then((response) => {
                if (response.data?.success) {
                    alert('Credentials Saved Successfully');
                } else {
                    alert('Unable to save the Credentials Right Now')
                }
            }).catch((error) => {
                alert('Unable to save the Credentials Right Now')
            })
        }

        useEffect(() => {
            if (loading) {
                axios.get(`/wp-admin/admin-ajax.php?method=get_post_mark_settings&action=auth_ajax&_wp_nonce=${nonce}`).then((response) => {
                    if (response.data?.success) {
                        setData({...response.data.data});
                    } else {
                        alert('Unable to Fetch the settings')
                    }
                }).catch((error) => {
                    alert('Unable to Fetch the Settings');
                }).finally(() => {
                    setLoading(false);
                })
            }
        }, [])

        return (
            <div className="bounces-settings">
                <form>
                    <label htmlFor="fname">Post Mark Token</label>
                    <input type="text" id="post_mark_token" name="post_mark_token" placeholder="Post Mark Token"
                           value={data.token}
                           onChange={(e) => {
                               setData({...data, token: e.target.value})
                           }}/>


                    <label htmlFor="user_name">Your Site URL</label>
                    <input type="text" id="site_url" name="site_url" placeholder="Your Site URL"
                           value={data.site_url}
                           onChange={(e) => {
                               setData({...data, site_url: e.target.value})
                           }}/>


                    <label htmlFor="user_name">List Monk User Name</label>
                    <input type="text" id="user_name" name="user_name" placeholder="User Name"
                           value={data.user_name}
                           onChange={(e) => {
                               setData({...data, user_name: e.target.value})
                           }}/>

                    <label htmlFor="password">List Monk Password</label>
                    <input type="text" id="password" name="password" placeholder="Your Password"
                           value={data.password}
                           onChange={(e) => {
                               setData({...data, password: e.target.value})
                           }}/>

                    <input type="submit" value="Submit" onClick={saveChanges}/>
                </form>
            </div>
        );
    }
;
export default Settings;