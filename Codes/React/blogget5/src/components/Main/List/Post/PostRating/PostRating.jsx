import React from 'react';
import style from '../Post.module.css';
import PropTypes from 'prop-types';

export const PostRating = ({ups}) => (
  <div className={style.rating}>
    <button className={style.up} aria-label='Увеличить рейтинг' />
    <p>{ups}</p>
    <button className={style.down} aria-label='Уменьшить рейтинг' />
  </div>
);


PostRating.propTypes = {
  ups: PropTypes.number,
};
