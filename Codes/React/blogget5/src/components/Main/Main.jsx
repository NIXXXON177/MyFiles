import React from 'react';
import style from './Main.module.css';
import Layout from '../Layout';
import Tabs from './Tabs';
import List from './List';

export const Main = () => (
  <main className={style.main}>
    <Layout>
      <Tabs />
      <List />
    </Layout>
  </main>
);

// React.createElement(Layout, {}, [
//   React.createElement(Tabs, {}, []),
//   React.createElement(List, {}, []),
// ]);
