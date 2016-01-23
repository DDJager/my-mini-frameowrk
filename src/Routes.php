<?php

namespace Src;

return [
    ["GET", "/about", ["Src\Controllers\About", "show"]],
    ["GET", "/", ["Src\Controllers\Homepage", "show"]],
];