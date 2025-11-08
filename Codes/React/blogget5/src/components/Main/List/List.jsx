import React from 'react';
import style from './List.module.css';
import Post from './Post';

export const List = props => {
  const postsData = [
    {
      thumbnail: '',
      title: 'Title1',
      author: 'Nick1',
      ups: 25,
      date: '2022-01-14T16:42:00.000Z',
      id: '184'
    },
    {
      thumbnail: '',
      title: 'Title2',
      author: 'Nick2',
      ups: 36,
      date: '2022-05-21T09:18:00.000Z',
      id: '765'
    },
    {
      thumbnail: '',
      title: 'Title3',
      author: 'Nick3',
      ups: 87,
      date: '2022-03-17T00:45:00.000Z',
      id: '153'
    },
    {
      thumbnail: '',
      title: 'Title4',
      author: 'Nick4',
      ups: 45,
      date: '2022-02-24T08:00:00.000Z',
      id: '458'
    },
  ];

  return (
    <ul className={style.list}>
      {postsData.map((postData) => (
        <Post key={postData.id} postData={postData} />
      ))}
    </ul>
  );
};
