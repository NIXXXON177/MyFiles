import React from 'react';
import style from '../Post.module.css';
import formatDate from '../../../../../utils/formatDate.js';
import PropTypes from 'prop-types';

export const PostDate = ({date}) => (
  <time className={style.date} dateTime={date}>
    {formatDate(date)}
  </time>
);

PostDate.propTypes = {
  date: PropTypes.string,
};

