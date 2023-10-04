import React from 'react';
const Paginate = ({ perPage, totalLength, paginate, previousPage, nextPage }) => {
    return (
        <div className="pagination-container">
            <ul className="pagination">
                <li>{totalLength}</li>
                <li  className="page-number">
                    <input min="0"  type="number"  onChange={(e) => paginate(e.target.value)}/>
                </li>
                <li  className="page-number">
                    {Math.ceil(totalLength / perPage)}
                </li>
            </ul>
        </div>
    );
};

export default Paginate;