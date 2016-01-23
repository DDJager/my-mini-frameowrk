<?php

namespace Src;

return [
    ["GET", "/hello-world", function () {
        echo "Hello World";
    }],
    ["GET", "/another-route", function () {
        echo "This works too";
    }],
];