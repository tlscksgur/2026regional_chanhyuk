<?php

get('/', function() {
  views("home");
});

get('/sub01', function() {
  views("sub01");
});

get('/libraryLive', function() {
  views("user/libraryLive");
});

