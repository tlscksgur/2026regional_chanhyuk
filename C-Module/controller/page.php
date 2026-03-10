<?php

get('/', function() {
  views("home");
});

get('/sub01', function() {
  views("sub01");
});
