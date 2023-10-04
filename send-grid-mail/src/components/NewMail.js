import React, {useEffect, useState, useContext} from "react";
import axios from 'axios';


import WpDataContext from "./Context/WPDataContext";

const NewMail = () => {
        const initialData = {
            from_mail: '',
            to_mail: '',
            mail_content: '',
        };

        const [data, setData] = useState(initialData)

        const nonce = document.getElementById('_wp_post_mark_nonce').value;

        const wpData = useContext(WpDataContext);

        const sendMail = (e) => {
            e.preventDefault();

            if (!data.from_mail && !data.to_mail && !data.mail_content) {
                alert('please fill all these fields');
                return
            }

            let fields = new FormData();

            fields.append('method', 'send_email_via_mail_gun');
            fields.append('action', 'auth_ajax');
            fields.append('mail_content', data.mail_content);
            fields.append('to_mail', data.to_mail);
            fields.append('from_mail', data.from_mail);
            fields.append('_wp_nonce', nonce);

            axios.post('/wp-admin/admin-ajax.php', fields).then((response) => {
                if (response.data?.success) {
                    alert('Mail Send Successfully');
                    setData(initialData);
                } else {
                    alert('Unable to Send Mail Now')
                }
            }).catch((error) => {
                alert('Unable to send the Email Right Now. Please try again later')
            })
        }
        return (
            <div className="new-mail">
                <form>
                    <div>
                        <label htmlFor="to_mail">To Email Id</label>
                        <input type="email" id="to_mail" name="to_mail" placeholder="To Mail Id"
                               required="required"
                               value={data.to_mail}
                               onChange={(e) => {
                                   setData({...data, to_mail: e.target.value})
                               }}/>
                    </div>

                    <div>
                        <label htmlFor="from_mail">From Email Id</label>
                        <input type="text" id="from_mail" name="from_mail" placeholder="From Mail Id"
                               value={data.from_mail}
                               required="required"
                               onChange={(e) => {
                                   setData({...data, from_mail: e.target.value})
                               }}/>
                    </div>

                    <div>
                        <label htmlFor="user_name">Mail Content</label>
                        <textarea id="mail_content" name="mail_content"
                                  rows='8'
                                  required="required"
                                  onChange={(e) => {
                                      setData({...data, mail_content: e.target.value})
                                  }}>{data.mail_content}
                    </textarea>
                    </div>
                    <button className="button button-primary" type="submit" value="Submit" onClick={sendMail}>Send Email
                    </button>
                </form>
            </div>
        );
    }
;
export default NewMail;