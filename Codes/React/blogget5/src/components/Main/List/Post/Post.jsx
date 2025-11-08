import React from 'react';
import style from './Post.module.css';
import PropTypes from 'prop-types';
import PostImage from './PostImage';
import PostContent from './PostContent';
import PostRating from './PostRating';
import PostDeleteButton from './PostDeleteButton';
import PostDate from './PostDate';

export const Post = ({postData}) => {
  const {title, author, ups, date} = postData;

  return (
    <li className={style.post}>
      <PostImage />
      <PostContent title={title} author={author} />
      <PostRating ups={ups} />
      <PostDeleteButton />
      <PostDate date={date} />
    </li>
  );
};

/**
 * Основная идея — ЗАДАНИЕ которое прилагалось.
 * Моё решение — вынести все элементы поста в отдельные
 * компоненты для удобного доступа и их редактирования,
 * понятного обозначения в виде имени компонента.
 * ---------------
 * Алгоритм — вырезал часть кода отвечающий за конкретный элемент,
 * на его основе создавал компонент в той же папке Post
 * и вставлял туда эту часть кода с его экспортом.
 * Из родительского Post.jsx передал каждому компоненту необходимые данные,
 * внизу родительского и каждого компонента "propType'ировал" переданные данные.
 * И наконец добавил кнопку, сразу в виде компонента
 */

Post.propTypes = {
  postData: PropTypes.shape({
    title: PropTypes.string,
    author: PropTypes.string,
    ups: PropTypes.number,
    date: PropTypes.string,
  }),
};
