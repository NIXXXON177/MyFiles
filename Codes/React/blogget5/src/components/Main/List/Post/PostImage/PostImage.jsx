import React from 'react';
import style from '../Post.module.css';
import notphoto from '../img/notphoto.jpg';

export const PostImage = () => (
  <img className={style.img} src={notphoto} alt='title' />
);
