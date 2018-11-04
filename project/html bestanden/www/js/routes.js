'use strict';
var routes = [
  // Index page
  {
    path: '/',
    url: './index.html',
    name: 'home',
  },
  // project page
  {
    path: '/project/',
    url: './pages/project.html',
    name: 'project',
  },
  // locatie page
  {
    path: '/locatie/',
    url: './pages/locatie.html',
    name: 'locatie',
  },
  // data page
  {
    path: '/data/',
    url: './pages/data.html',
    name: 'data',
  },
  // make room page
  {
    path: '/makeRoom/',
    url: './pages/makeRoom.html',
    name: 'makeRoom',
  },
  //join room page
  {
    path: '/joinRoom/',
    url: './pages/joinRoom.html',
    name: 'joinRoom',
  },
  {
    path: '/game/',
    url: './pages/game.html',
    name: 'game',
  },

  // Default route (404 page). MUST BE THE LAST
  {
    path: '(.*)',
    url: './pages/404.html',
  },
];
