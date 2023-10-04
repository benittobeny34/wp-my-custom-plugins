import React, {useEffect, useState, useContext} from "react";
import axios from 'axios';

import Paginate from './Paginate';

import wordpressLocalizeData from './../wordpress-localized-data';
import WpDataContext from "./Context/WPDataContext";

const Bounces = () => {

    const wpData = useContext(WpDataContext);

    const [bounces, setBounces] = useState({TotalCount: 0, Bounces: []});

    const [currentPage, setCurrentPage] = useState(1);

    const [bouncesPerPage, setBouncesPerPage] = useState(5);

    const [filteredData, setFilteredData] = useState({
        "fromDate": null,
        "toDate": null,
        "email": null
    })

    const nonce = document.getElementById('_wp_post_mark_nonce').value;

    console.log(nonce);

    const indexOfLastBounce = currentPage * bouncesPerPage;
    const indexOfFirstBounce = indexOfLastBounce - bouncesPerPage;

    const previousPage = () => {
        if (currentPage !== 1) {
            setCurrentPage(currentPage - 1);
        }
    };

    const nextPage = () => {
        if (currentPage !== Math.ceil(bounces.TotalCount / bouncesPerPage)) {
            setCurrentPage(currentPage + 1);
        }
    };

    const paginate = (pageNumber) => {
        setCurrentPage(pageNumber);
    };

    const postSingleBounce = (e) => {
        let Id = e.target.getAttribute('data-bounce-id');

        let selectedBounce = bounces.Bounces.filter((bounce) => {
            return bounce.ID == Id;
        })

        if (selectedBounce.length == 1) {
            let query = `subscribers.email in ('${selectedBounce[0].Email}')`;
            makeRequestToBlockSubscribers(query);
        }
    }

    const postAllBouncesInThisPage = () => {

        let length = bounces.Bounces.length;
        let confirmation = confirm(`Are you sure want to process these ${length} bounces?`);

        if (!confirmation) {
            console.log('Admin Not Confirmed Returning');
            return;
        }
        let query = '';

        let emails = '';
        bounces.Bounces.map((bounce) => {
            emails += `'${bounce.Email}'` + `,`;
        });
        emails = emails.replace(/,$/, '');
        query = `subscribers.email in (${emails})`;

        makeRequestToBlockSubscribers(query);
    }

    const makeRequestToBlockSubscribers = (query) => {
        var data = new FormData();

        data.append('method', 'post_bounces');
        data.append('action', 'auth_ajax');
        data.append('query', query);
        data.append('_wp_nonce', nonce);

        axios.post('/wp-admin/admin-ajax.php', data).then((response) => {
            if (response.data?.success) {
                alert('Bounces Posted to ListMonk');
            } else {
                alert('Unable to Process the Bounces Now. Please check Later')
            }
        }).catch((error) => {
            alert('Unable to Process the Bounces Now. Please check Later')
        })
    }

    const updateBouncesList = () => {

        var data = new FormData();

        data.append('method', 'post_mark_get_bounces');
        data.append('action', 'auth_ajax');
        data.append('offset', (currentPage - 1) * bouncesPerPage);
        data.append('per_page', bouncesPerPage);
        data.append('_wp_nonce', nonce);

        if (filteredData.fromDate && filteredData.toDate) {
            data.append('fromDate', filteredData.fromDate);
            data.append('toDate', filteredData.toDate);
        }

        if (filteredData.email) {
            data.append('email', filteredData.email);
        }

        axios.post('/wp-admin/admin-ajax.php', data).then((response) => {
            if (response.data?.success) {
                setBounces(response.data.data)
            } else {
                alert("Unable to Fetch the Bounces Right Now, Please Check your token is valid.")
            }
        }).catch((error) => {
            alert('Unable to Fetch the Bounces right Now')
            console.log(error);
        })
    }

    useEffect(() => {
        updateBouncesList();
    }, [bouncesPerPage, currentPage]);

    return (
        <div className="bounces-container">
            <div className="title">
                <h1>Bounces</h1>
                <div className="bounces-header-section">
                    <div className="bounces-filter">
                        <div>
                            <input type="datetime-local" name="start_date" onChange={(e) => {
                                setFilteredData({...filteredData, fromDate: e.target.value})
                            }}/>
                            <input type="datetime-local" name="to_date" onChange={(e) => {
                                setFilteredData({...filteredData, toDate: e.target.value})
                            }}/>
                            <input type="text" name="email" placeholder="Search By Email" onChange={(e) => {
                                setFilteredData({...filteredData, email: e.target.value})
                            }}/>
                            <button className="button-primary" onClick={updateBouncesList}>Filter</button>

                        </div>
                        <div>
                            <button className="button-danger" onClick={postAllBouncesInThisPage}>Post All Bounce In This
                                Page
                            </button>

                            <label htmlFor="per_page">Per Page</label>
                            <select name="per_page" id="per_page" onChange={(e) => {
                                setBouncesPerPage(e.target.value);
                            }}>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            {bounces.TotalCount ? (
                <div className="blog-content-section">
                    <div className="bounces">
                        <table>
                            <thead>
                            <tr>
                                <td>ID</td>
                                <td>Type</td>
                                <td>Type Code</td>
                                <td>Name</td>
                                <td>Tag</td>
                                <td>MessageId</td>
                                <td>ServerId</td>
                                <td>MessageStream</td>
                                <td>Description</td>
                                <td>Details</td>
                                <td>Email</td>
                                <td>From</td>
                                <td>BouncedAt</td>
                                <td>Subject</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            {bounces.Bounces?.map((bounce, id) => {
                                return (
                                    <tr key={bounce.ID}>
                                        <td>{bounce.ID}</td>
                                        <td>{bounce.Type}</td>
                                        <td>{bounce.TypeCode}</td>
                                        <td>{bounce.Name}</td>
                                        <td>{bounce.Tag ?? '-'}</td>
                                        <td>{bounce.MessageID}</td>
                                        <td>{bounce.ServerID}</td>
                                        <td>{bounce.MessageStream}</td>
                                        <td>{bounce.Description}</td>
                                        <td>{bounce.Details}</td>
                                        <td>{bounce.Email}</td>
                                        <td>{bounce.From}</td>
                                        <td>{bounce.BouncedAt}</td>
                                        <td>{bounce.Subject}</td>
                                        <td>
                                            <div className="activate-bounce">
                                                <button className="button-primary" data-bounce-id={bounce.ID}
                                                        onClick={(e) => {
                                                            postSingleBounce(e)
                                                        }}>Post
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                )
                            })}
                            </tbody>
                        </table>
                    </div>
                    <Paginate
                        perPage={bouncesPerPage}
                        totalLength={bounces.TotalCount}
                        paginate={paginate}
                        previousPage={previousPage}
                        nextPage={nextPage}
                    />
                </div>
            ) : (
                <div className="loading">No Bounces Found / Loading...</div>
            )}
        </div>
    );
};
export default Bounces;