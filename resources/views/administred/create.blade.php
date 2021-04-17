@extends('layouts.main')
@section('content')

    <style>
        .bootstrap-table .fixed-table-toolbar .columns-right{
            float: left !important;
        }

        .bootstrap-table .fixed-table-toolbar .search {
            float: left !important;
        }

        /* Form Wizard ================================= */
        .wizard,
        .tabcontrol {
            display: block;
            width: 100%;
            overflow: hidden; }

        .wizard a,
        .tabcontrol a {
            outline: 0; }

        .wizard ul,
        .tabcontrol ul {
            list-style: none !important;
            padding: 0;
            margin: 0; }

        .wizard ul > li, .tabcontrol ul > li {
            display: block;
            padding: 0; }

        /* Accessibility */
        .wizard > .steps .current-info,
        .tabcontrol > .steps .current-info,
        .wizard > .content > .title,
        .tabcontrol > .content > .title {
            position: absolute;
            left: -999em; }

        .wizard > .steps {
            position: relative;
            display: block;
            width: 100%; }

        .wizard.vertical > .steps {
            float: left;
            width: 30%; }

        .wizard.vertical > .steps > ul > li {
            float: none;
            width: 100%; }

        .wizard.vertical > .content {
            float: left;
            margin: 0 0 0.5em 0;
            width: 70%; }

        .wizard.vertical > .actions {
            float: right;
            width: 100%; }

        .wizard.vertical > .actions > ul > li {
            margin: 0 0 0 1em; }

        .wizard > .steps .number {
            font-size: 1.429em; }

        .wizard > .steps > ul > li {
            width: 25%;
            float: left; }

        .wizard > .actions > ul > li {
            float: left; }

        .wizard > .steps a {
            display: block;
            width: auto;
            margin: 0 0.5em 0.5em;
            padding: 1em 1em;
            text-decoration: none;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px; }
        .wizard > .steps a:hover, .wizard > .steps a:active {
            display: block;
            width: auto;
            margin: 0 0.5em 0.5em;
            padding: 1em 1em;
            text-decoration: none;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px; }

        .wizard > .steps .disabled a {
            background: #eee;
            color: #aaa;
            cursor: default; }
        .wizard > .steps .disabled a:hover, .wizard > .steps .disabled a:active {
            background: #eee;
            color: #aaa;
            cursor: default; }

        .wizard > .steps .current a {
            background: #2184be;
            color: #fff;
            cursor: default; }
        .wizard > .steps .current a:hover, .wizard > .steps .current a:active {
            background: #2184be;
            color: #fff;
            cursor: default; }

        .wizard > .steps .done a {
            background: #9dc8e2;
            color: #fff; }
        .wizard > .steps .done a:hover, .wizard > .steps .done a:active {
            background: #9dc8e2;
            color: #fff; }

        .wizard > .steps .error a {
            background: #ff3111;
            color: #fff; }
        .wizard > .steps .error a:hover, .wizard > .steps .error a:active {
            background: #ff3111;
            color: #fff; }

        .wizard > .content {
            border: 1px solid #ddd;
            display: block;
            margin: 0.5em;
            min-height: 35em;
            overflow: hidden;
            position: relative;
            width: auto; }

        .wizard > .actions {
            position: relative;
            display: block;
            text-align: right;
            width: 100%; }

        .wizard > .actions > ul {
            display: inline-block;
            text-align: right; }
        .wizard > .actions > ul > li {
            margin: 0 0.5em; }

        .wizard > .actions a {
            background: #009688;
            color: #fff;
            display: block;
            padding: 0.5em 1em;
            text-decoration: none;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            -ms-border-radius: 0;
            border-radius: 0; }
        .wizard > .actions a:hover, .wizard > .actions a:active {
            background: #009688;
            color: #fff;
            display: block;
            padding: 0.5em 1em;
            text-decoration: none;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            -ms-border-radius: 0;
            border-radius: 0; }

        .wizard > .actions .disabled a {
            background: #eee;
            color: #aaa; }
        .wizard > .actions .disabled a:hover, .wizard > .actions .disabled a:active {
            background: #eee;
            color: #aaa; }

        .tabcontrol > .steps {
            position: relative;
            display: block;
            width: 100%; }
        .tabcontrol > .steps > ul {
            position: relative;
            margin: 6px 0 0 0;
            top: 1px;
            z-index: 1; }
        .tabcontrol > .steps > ul > li {
            float: left;
            margin: 5px 2px 0 0;
            padding: 1px;
            -webkit-border-top-left-radius: 5px;
            -webkit-border-top-right-radius: 5px;
            -moz-border-radius-topleft: 5px;
            -moz-border-radius-topright: 5px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px; }
        .tabcontrol > .steps > ul > li:hover {
            background: #edecec;
            border: 1px solid #bbb;
            padding: 0; }
        .tabcontrol > .steps > ul > li.current {
            background: #fff;
            border: 1px solid #bbb;
            border-bottom: 0 none;
            padding: 0 0 1px 0;
            margin-top: 0; }
        .tabcontrol > .steps > ul > li.current > a {
            padding: 15px 30px 10px 30px; }
        .tabcontrol > .steps > ul > li > a {
            color: #5f5f5f;
            display: inline-block;
            border: 0 none;
            margin: 0;
            padding: 10px 30px;
            text-decoration: none; }
        .tabcontrol > .steps > ul > li > a:hover {
            text-decoration: none; }

        .tabcontrol > .content {
            position: relative;
            display: inline-block;
            width: 100%;
            height: 35em;
            overflow: hidden;
            border-top: 1px solid #bbb;
            padding-top: 20px; }
        .tabcontrol > .content > .body {
            float: left;
            position: absolute;
            width: 95%;
            height: 95%;
            padding: 2.5%; }
        .tabcontrol > .content > .body ul {
            list-style: disc !important; }
        .tabcontrol > .content > .body ul > li {
            display: list-item; }

        .wizard .content {
            min-height: 245px;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            -ms-border-radius: 0;
            border-radius: 0;
            overflow-y: auto; }
        .wizard .content .body {
            padding: 15px; }

        .wizard .steps a {
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            -ms-border-radius: 0;
            border-radius: 0;
            -moz-transition: 0.5s;
            -o-transition: 0.5s;
            -webkit-transition: 0.5s;
            transition: 0.5s; }
        .wizard .steps a:active, .wizard .steps a:focus, .wizard .steps a:hover {
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            -ms-border-radius: 0;
            border-radius: 0; }

        .wizard .steps .done a {
            background-color: rgba(0, 150, 136, 0.6); }
        .wizard .steps .done a:hover, .wizard .steps .done a:active, .wizard .steps .done a:focus {
            background-color: rgba(0, 150, 136, 0.5); }

        .wizard .steps .error a {
            background-color: #F44336 !important; }

        .wizard .steps .current a {
            background-color: #009688; }
        .wizard .steps .current a:active, .wizard .steps .current a:focus, .wizard .steps .current a:hover {
            background-color: #009688; }

        /* Waves ======================================= */
        .waves-effect.waves-red .waves-ripple {
            background: rgba(244, 67, 54, 0.5); }

        .waves-effect.waves-pink .waves-ripple {
            background: rgba(233, 30, 99, 0.5); }

        .waves-effect.waves-purple .waves-ripple {
            background: rgba(156, 39, 176, 0.5); }

        .waves-effect.waves-deep-purple .waves-ripple {
            background: rgba(103, 58, 183, 0.5); }

        .waves-effect.waves-indigo .waves-ripple {
            background: rgba(63, 81, 181, 0.5); }

        .waves-effect.waves-blue .waves-ripple {
            background: rgba(33, 150, 243, 0.5); }

        .waves-effect.waves-light-blue .waves-ripple {
            background: rgba(3, 169, 244, 0.5); }

        .waves-effect.waves-cyan .waves-ripple {
            background: rgba(0, 188, 212, 0.5); }

        .waves-effect.waves-teal .waves-ripple {
            background: rgba(0, 150, 136, 0.5); }

        .waves-effect.waves-green .waves-ripple {
            background: rgba(76, 175, 80, 0.5); }

        .waves-effect.waves-light-green .waves-ripple {
            background: rgba(139, 195, 74, 0.5); }

        .waves-effect.waves-lime .waves-ripple {
            background: rgba(205, 220, 57, 0.5); }

        .waves-effect.waves-yellow .waves-ripple {
            background: rgba(255, 232, 33, 0.5); }

        .waves-effect.waves-amber .waves-ripple {
            background: rgba(255, 193, 7, 0.5); }

        .waves-effect.waves-orange .waves-ripple {
            background: rgba(255, 152, 0, 0.5); }

        .waves-effect.waves-deep-orange .waves-ripple {
            background: rgba(255, 87, 34, 0.5); }

        .waves-effect.waves-brown .waves-ripple {
            background: rgba(121, 85, 72, 0.5); }

        .waves-effect.waves-grey .waves-ripple {
            background: rgba(158, 158, 158, 0.5); }

        .waves-effect.waves-blue-grey .waves-ripple {
            background: rgba(96, 125, 139, 0.5); }

        .waves-effect.waves-black .waves-ripple {
            background: rgba(0, 0, 0, 0.5); }

        .waves-effect.waves-white .waves-ripple {
            background: rgba(255, 255, 255, 0.5); }

        /* Page Loader ================================= */
        .page-loader-wrapper {
            z-index: 99999999;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: #eee;
            overflow: hidden;
            text-align: center; }
        .page-loader-wrapper p {
            font-size: 13px;
            margin-top: 10px;
            font-weight: bold;
            color: #444; }
        .page-loader-wrapper .loader {
            position: relative;
            top: calc(50% - 30px); }

        /* Preloaders ================================== */
        .md-preloader .pl-red {
            stroke: #F44336; }

        .md-preloader .pl-pink {
            stroke: #E91E63; }

        .md-preloader .pl-purple {
            stroke: #9C27B0; }

        .md-preloader .pl-deep-purple {
            stroke: #673AB7; }

        .md-preloader .pl-indigo {
            stroke: #3F51B5; }

        .md-preloader .pl-blue {
            stroke: #2196F3; }

        .md-preloader .pl-light-blue {
            stroke: #03A9F4; }

        .md-preloader .pl-cyan {
            stroke: #00BCD4; }

        .md-preloader .pl-teal {
            stroke: #009688; }

        .md-preloader .pl-green {
            stroke: #4CAF50; }

        .md-preloader .pl-light-green {
            stroke: #8BC34A; }

        .md-preloader .pl-lime {
            stroke: #CDDC39; }

        .md-preloader .pl-yellow {
            stroke: #ffe821; }

        .md-preloader .pl-amber {
            stroke: #FFC107; }

        .md-preloader .pl-orange {
            stroke: #FF9800; }

        .md-preloader .pl-deep-orange {
            stroke: #FF5722; }

        .md-preloader .pl-brown {
            stroke: #795548; }

        .md-preloader .pl-grey {
            stroke: #9E9E9E; }

        .md-preloader .pl-blue-grey {
            stroke: #607D8B; }

        .md-preloader .pl-black {
            stroke: #000000; }

        .md-preloader .pl-white {
            stroke: #ffffff; }

        .preloader {
            display: inline-block;
            position: relative;
            width: 50px;
            height: 50px;
            -webkit-animation: container-rotate 1568ms linear infinite;
            -moz-animation: container-rotate 1568ms linear infinite;
            -o-animation: container-rotate 1568ms linear infinite;
            animation: container-rotate 1568ms linear infinite; }
        .preloader.pl-size-xl {
            width: 75px;
            height: 75px; }
        .preloader.pl-size-l {
            width: 60px;
            height: 60px; }
        .preloader.pl-size-md {
            width: 50px;
            height: 50px; }
        .preloader.pl-size-sm {
            width: 40px;
            height: 40px; }
        .preloader.pl-size-xs {
            width: 25px;
            height: 25px; }

        .spinner-layer {
            position: absolute;
            width: 100%;
            height: 100%;
            border-color: #F44336;
            -ms-opacity: 1;
            opacity: 1;
            -webkit-animation: fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            -moz-animation: fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            -o-animation: fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            animation: fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both; }
        .spinner-layer.pl-red {
            border-color: #F44336; }
        .spinner-layer.pl-pink {
            border-color: #E91E63; }
        .spinner-layer.pl-purple {
            border-color: #9C27B0; }
        .spinner-layer.pl-deep-purple {
            border-color: #673AB7; }
        .spinner-layer.pl-indigo {
            border-color: #3F51B5; }
        .spinner-layer.pl-blue {
            border-color: #2196F3; }
        .spinner-layer.pl-light-blue {
            border-color: #03A9F4; }
        .spinner-layer.pl-cyan {
            border-color: #00BCD4; }
        .spinner-layer.pl-teal {
            border-color: #009688; }
        .spinner-layer.pl-green {
            border-color: #4CAF50; }
        .spinner-layer.pl-light-green {
            border-color: #8BC34A; }
        .spinner-layer.pl-lime {
            border-color: #CDDC39; }
        .spinner-layer.pl-yellow {
            border-color: #ffe821; }
        .spinner-layer.pl-amber {
            border-color: #FFC107; }
        .spinner-layer.pl-orange {
            border-color: #FF9800; }
        .spinner-layer.pl-deep-orange {
            border-color: #FF5722; }
        .spinner-layer.pl-brown {
            border-color: #795548; }
        .spinner-layer.pl-grey {
            border-color: #9E9E9E; }
        .spinner-layer.pl-blue-grey {
            border-color: #607D8B; }
        .spinner-layer.pl-black {
            border-color: #000000; }
        .spinner-layer.pl-white {
            border-color: #ffffff; }

        .right {
            float: right !important; }

        .gap-patch {
            position: absolute;
            top: 0;
            left: 45%;
            width: 10%;
            height: 100%;
            overflow: hidden;
            border-color: inherit; }
        .gap-patch.circle {
            width: 1000%;
            left: -450%; }

        .circle-clipper {
            display: inline-block;
            position: relative;
            width: 50%;
            height: 100%;
            overflow: hidden;
            border-color: inherit; }
        .circle-clipper .circle {
            width: 200%;
            height: 100%;
            border-width: 3px;
            border-style: solid;
            border-color: inherit;
            border-bottom-color: transparent !important;
            -ms-border-radius: 50%;
            border-radius: 50%;
            -webkit-animation: none;
            animation: none;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0; }
        .circle-clipper.left .circle {
            left: 0;
            border-right-color: transparent !important;
            -webkit-transform: rotate(129deg);
            -moz-transform: rotate(129deg);
            -ms-transform: rotate(129deg);
            -o-transform: rotate(129deg);
            transform: rotate(129deg);
            -webkit-animation: left-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            -moz-animation: left-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            -o-animation: left-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            animation: left-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both; }
        .circle-clipper.right .circle {
            left: -100%;
            border-left-color: transparent !important;
            -webkit-transform: rotate(-129deg);
            -moz-transform: rotate(-129deg);
            -ms-transform: rotate(-129deg);
            -o-transform: rotate(-129deg);
            transform: rotate(-129deg);
            -webkit-animation: right-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            -moz-animation: right-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            -o-animation: right-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            animation: right-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both; }

        @-webkit-keyframes container-rotate {
            to {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg); } }

        @keyframes container-rotate {
            to {
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg); } }

        @-webkit-keyframes fill-unfill-rotate {
            12.5% {
                -webkit-transform: rotate(135deg);
                transform: rotate(135deg); }
            25% {
                -webkit-transform: rotate(270deg);
                transform: rotate(270deg); }
            37.5% {
                -webkit-transform: rotate(405deg);
                transform: rotate(405deg); }
            50% {
                -webkit-transform: rotate(540deg);
                transform: rotate(540deg); }
            62.5% {
                -webkit-transform: rotate(675deg);
                transform: rotate(675deg); }
            75% {
                -webkit-transform: rotate(810deg);
                transform: rotate(810deg); }
            87.5% {
                -webkit-transform: rotate(945deg);
                transform: rotate(945deg); }
            to {
                -webkit-transform: rotate(1080deg);
                transform: rotate(1080deg); } }

        @keyframes fill-unfill-rotate {
            12.5% {
                transform: rotate(135deg); }
            25% {
                transform: rotate(270deg); }
            37.5% {
                transform: rotate(405deg); }
            50% {
                transform: rotate(540deg); }
            62.5% {
                transform: rotate(675deg); }
            75% {
                transform: rotate(810deg); }
            87.5% {
                transform: rotate(945deg); }
            to {
                transform: rotate(1080deg); } }

        @-webkit-keyframes left-spin {
            from {
                -webkit-transform: rotate(130deg);
                -moz-transform: rotate(130deg);
                -ms-transform: rotate(130deg);
                -o-transform: rotate(130deg);
                transform: rotate(130deg); }
            50% {
                -webkit-transform: rotate(-5deg);
                -moz-transform: rotate(-5deg);
                -ms-transform: rotate(-5deg);
                -o-transform: rotate(-5deg);
                transform: rotate(-5deg); }
            to {
                -webkit-transform: rotate(130deg);
                -moz-transform: rotate(130deg);
                -ms-transform: rotate(130deg);
                -o-transform: rotate(130deg);
                transform: rotate(130deg); } }

        @keyframes left-spin {
            from {
                -moz-transform: rotate(130deg);
                -ms-transform: rotate(130deg);
                -o-transform: rotate(130deg);
                -webkit-transform: rotate(130deg);
                transform: rotate(130deg); }
            50% {
                -moz-transform: rotate(-5deg);
                -ms-transform: rotate(-5deg);
                -o-transform: rotate(-5deg);
                -webkit-transform: rotate(-5deg);
                transform: rotate(-5deg); }
            to {
                -moz-transform: rotate(130deg);
                -ms-transform: rotate(130deg);
                -o-transform: rotate(130deg);
                -webkit-transform: rotate(130deg);
                transform: rotate(130deg); } }

        @-webkit-keyframes right-spin {
            from {
                -webkit-transform: rotate(-130deg);
                -moz-transform: rotate(-130deg);
                -ms-transform: rotate(-130deg);
                -o-transform: rotate(-130deg);
                transform: rotate(-130deg); }
            50% {
                -webkit-transform: rotate(5deg);
                -moz-transform: rotate(5deg);
                -ms-transform: rotate(5deg);
                -o-transform: rotate(5deg);
                transform: rotate(5deg); }
            to {
                -webkit-transform: rotate(-130deg);
                -moz-transform: rotate(-130deg);
                -ms-transform: rotate(-130deg);
                -o-transform: rotate(-130deg);
                transform: rotate(-130deg); } }

        @-moz-keyframes right-spin {
            from {
                -moz-transform: rotate(-130deg);
                -ms-transform: rotate(-130deg);
                -o-transform: rotate(-130deg);
                -webkit-transform: rotate(-130deg);
                transform: rotate(-130deg); }
            50% {
                -moz-transform: rotate(5deg);
                -ms-transform: rotate(5deg);
                -o-transform: rotate(5deg);
                -webkit-transform: rotate(5deg);
                transform: rotate(5deg); }
            to {
                -moz-transform: rotate(-130deg);
                -ms-transform: rotate(-130deg);
                -o-transform: rotate(-130deg);
                -webkit-transform: rotate(-130deg);
                transform: rotate(-130deg); } }

        @keyframes right-spin {
            from {
                -moz-transform: rotate(-130deg);
                -ms-transform: rotate(-130deg);
                -o-transform: rotate(-130deg);
                -webkit-transform: rotate(-130deg);
                transform: rotate(-130deg); }
            50% {
                -moz-transform: rotate(5deg);
                -ms-transform: rotate(5deg);
                -o-transform: rotate(5deg);
                -webkit-transform: rotate(5deg);
                transform: rotate(5deg); }
            to {
                -moz-transform: rotate(-130deg);
                -ms-transform: rotate(-130deg);
                -o-transform: rotate(-130deg);
                -webkit-transform: rotate(-130deg);
                transform: rotate(-130deg); } }

        /* Navbars ===================================== */
        .navbar {
            font-family: "Roboto", sans-serif;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            -ms-border-radius: 0;
            border-radius: 0;
            -webkit-box-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
            -moz-box-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
            -ms-box-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
            border: none;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 12;
            width: 100%; }
        .navbar .navbar-brand {
            white-space: nowrap;
            -ms-text-overflow: ellipsis;
            -o-text-overflow: ellipsis;
            text-overflow: ellipsis;
            overflow: hidden; }
        .navbar .navbar-custom-right-menu {
            float: right; }
        .navbar .navbar-toggle {
            text-decoration: none;
            color: #fff;
            width: 20px;
            height: 20px;
            margin-top: -4px;
            margin-right: 17px; }
        .navbar .navbar-toggle:before {
            content: '\E8D5';
            font-family: 'Material Icons';
            font-size: 26px; }
        .navbar .navbar-collapse.in {
            overflow: visible; }

        .ls-closed .sidebar {
            margin-left: -300px; }

        .ls-closed section.content {
            margin-left: 15px; }

        .ls-closed .bars:after, .ls-closed .bars:before {
            font-family: 'Material Icons';
            font-size: 24px;
            position: absolute;
            top: 18px;
            left: 20px;
            margin-right: 10px;
            -moz-transform: scale(0);
            -ms-transform: scale(0);
            -o-transform: scale(0);
            -webkit-transform: scale(0);
            transform: scale(0);
            -moz-transition: all 0.3s;
            -o-transition: all 0.3s;
            -webkit-transition: all 0.3s;
            transition: all 0.3s; }

        .ls-closed .bars:before {
            content: '\E5D2';
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            -webkit-transform: scale(1);
            transform: scale(1); }

        .ls-closed .bars:after {
            content: '\E5C4';
            -moz-transform: scale(0);
            -ms-transform: scale(0);
            -o-transform: scale(0);
            -webkit-transform: scale(0);
            transform: scale(0); }

        .ls-closed .navbar-brand {
            margin-left: 30px; }

        .overlay-open .bars:before {
            -moz-transform: scale(0);
            -ms-transform: scale(0);
            -o-transform: scale(0);
            -webkit-transform: scale(0);
            transform: scale(0); }

        .overlay-open .bars:after {
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            -webkit-transform: scale(1);
            transform: scale(1); }

        .navbar-header {
            padding: 10px 7px; }
        .navbar-header .bars {
            float: left;
            text-decoration: none; }

        .navbar-nav > li > a {
            padding: 7px 7px 2px 7px;
            margin-top: 17px;
            margin-left: 5px; }

        .navbar-nav .dropdown-menu {
            margin-top: -40px !important; }

        .label-count {
            position: absolute;
            top: 2px;
            right: 6px;
            font-size: 10px;
            line-height: 15px;
            background-color: #000;
            padding: 0 4px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            -ms-border-radius: 3px;
            border-radius: 3px; }

        .col-red .navbar .navbar-brand,
        .col-red .navbar .navbar-brand:hover,
        .col-red .navbar .navbar-brand:active,
        .col-red .navbar .navbar-brand:focus {
            color: #fff; }

        .col-red .navbar .nav > li > a:hover,
        .col-red .navbar .nav > li > a:focus,
        .col-red .navbar .nav .open > a,
        .col-red .navbar .nav .open > a:hover,
        .col-red .navbar .nav .open > a:focus {
            background-color: rgba(0, 0, 0, 0.05); }

        .col-red .navbar .nav > li > a {
            color: #fff; }

        .col-red .navbar .bars {
            float: left;
            padding: 10px 20px;
            font-size: 22px;
            color: #fff;
            margin-right: 10px;
            margin-left: -10px;
            margin-top: 4px; }

        .col-red .navbar .bars:hover {
            background-color: rgba(0, 0, 0, 0.08); }

        .col-pink .navbar .navbar-brand,
        .col-pink .navbar .navbar-brand:hover,
        .col-pink .navbar .navbar-brand:active,
        .col-pink .navbar .navbar-brand:focus {
            color: #fff; }

        .col-pink .navbar .nav > li > a:hover,
        .col-pink .navbar .nav > li > a:focus,
        .col-pink .navbar .nav .open > a,
        .col-pink .navbar .nav .open > a:hover,
        .col-pink .navbar .nav .open > a:focus {
            background-color: rgba(0, 0, 0, 0.05); }

        .col-pink .navbar .nav > li > a {
            color: #fff; }

        .col-pink .navbar .bars {
            float: left;
            padding: 10px 20px;
            font-size: 22px;
            color: #fff;
            margin-right: 10px;
            margin-left: -10px;
            margin-top: 4px; }

        .col-pink .navbar .bars:hover {
            background-color: rgba(0, 0, 0, 0.08); }

        .col-purple .navbar .navbar-brand,
        .col-purple .navbar .navbar-brand:hover,
        .col-purple .navbar .navbar-brand:active,
        .col-purple .navbar .navbar-brand:focus {
            color: #fff; }

        .col-purple .navbar .nav > li > a:hover,
        .col-purple .navbar .nav > li > a:focus,
        .col-purple .navbar .nav .open > a,
        .col-purple .navbar .nav .open > a:hover,
        .col-purple .navbar .nav .open > a:focus {
            background-color: rgba(0, 0, 0, 0.05); }

        .col-purple .navbar .nav > li > a {
            color: #fff; }

        .col-purple .navbar .bars {
            float: left;
            padding: 10px 20px;
            font-size: 22px;
            color: #fff;
            margin-right: 10px;
            margin-left: -10px;
            margin-top: 4px; }

        .col-purple .navbar .bars:hover {
            background-color: rgba(0, 0, 0, 0.08); }

        .col-deep-purple .navbar .navbar-brand,
        .col-deep-purple .navbar .navbar-brand:hover,
        .col-deep-purple .navbar .navbar-brand:active,
        .col-deep-purple .navbar .navbar-brand:focus {
            color: #fff; }

        .col-deep-purple .navbar .nav > li > a:hover,
        .col-deep-purple .navbar .nav > li > a:focus,
        .col-deep-purple .navbar .nav .open > a,
        .col-deep-purple .navbar .nav .open > a:hover,
        .col-deep-purple .navbar .nav .open > a:focus {
            background-color: rgba(0, 0, 0, 0.05); }

        .col-deep-purple .navbar .nav > li > a {
            color: #fff; }

        .col-deep-purple .navbar .bars {
            float: left;
            padding: 10px 20px;
            font-size: 22px;
            color: #fff;
            margin-right: 10px;
            margin-left: -10px;
            margin-top: 4px; }

        .col-deep-purple .navbar .bars:hover {
            background-color: rgba(0, 0, 0, 0.08); }

        .col-indigo .navbar .navbar-brand,
        .col-indigo .navbar .navbar-brand:hover,
        .col-indigo .navbar .navbar-brand:active,
        .col-indigo .navbar .navbar-brand:focus {
            color: #fff; }

        .col-indigo .navbar .nav > li > a:hover,
        .col-indigo .navbar .nav > li > a:focus,
        .col-indigo .navbar .nav .open > a,
        .col-indigo .navbar .nav .open > a:hover,
        .col-indigo .navbar .nav .open > a:focus {
            background-color: rgba(0, 0, 0, 0.05); }

        .col-indigo .navbar .nav > li > a {
            color: #fff; }

        .col-indigo .navbar .bars {
            float: left;
            padding: 10px 20px;
            font-size: 22px;
            color: #fff;
            margin-right: 10px;
            margin-left: -10px;
            margin-top: 4px; }

        .col-indigo .navbar .bars:hover {
            background-color: rgba(0, 0, 0, 0.08); }

        .col-blue .navbar .navbar-brand,
        .col-blue .navbar .navbar-brand:hover,
        .col-blue .navbar .navbar-brand:active,
        .col-blue .navbar .navbar-brand:focus {
            color: #fff; }

        .col-blue .navbar .nav > li > a:hover,
        .col-blue .navbar .nav > li > a:focus,
        .col-blue .navbar .nav .open > a,
        .col-blue .navbar .nav .open > a:hover,
        .col-blue .navbar .nav .open > a:focus {
            background-color: rgba(0, 0, 0, 0.05); }

        .col-blue .navbar .nav > li > a {
            color: #fff; }

        .col-blue .navbar .bars {
            float: left;
            padding: 10px 20px;
            font-size: 22px;
            color: #fff;
            margin-right: 10px;
            margin-left: -10px;
            margin-top: 4px; }

        .col-blue .navbar .bars:hover {
            background-color: rgba(0, 0, 0, 0.08); }

        .col-light-blue .navbar .navbar-brand,
        .col-light-blue .navbar .navbar-brand:hover,
        .col-light-blue .navbar .navbar-brand:active,
        .col-light-blue .navbar .navbar-brand:focus {
            color: #fff; }

        .col-light-blue .navbar .nav > li > a:hover,
        .col-light-blue .navbar .nav > li > a:focus,
        .col-light-blue .navbar .nav .open > a,
        .col-light-blue .navbar .nav .open > a:hover,
        .col-light-blue .navbar .nav .open > a:focus {
            background-color: rgba(0, 0, 0, 0.05); }

        .col-light-blue .navbar .nav > li > a {
            color: #fff; }

        .col-light-blue .navbar .bars {
            float: left;
            padding: 10px 20px;
            font-size: 22px;
            color: #fff;
            margin-right: 10px;
            margin-left: -10px;
            margin-top: 4px; }

        .col-light-blue .navbar .bars:hover {
            background-color: rgba(0, 0, 0, 0.08); }

        .col-cyan .navbar .navbar-brand,
        .col-cyan .navbar .navbar-brand:hover,
        .col-cyan .navbar .navbar-brand:active,
        .col-cyan .navbar .navbar-brand:focus {
            color: #fff; }

        .col-cyan .navbar .nav > li > a:hover,
        .col-cyan .navbar .nav > li > a:focus,
        .col-cyan .navbar .nav .open > a,
        .col-cyan .navbar .nav .open > a:hover,
        .col-cyan .navbar .nav .open > a:focus {
            background-color: rgba(0, 0, 0, 0.05); }

        .col-cyan .navbar .nav > li > a {
            color: #fff; }

        .col-cyan .navbar .bars {
            float: left;
            padding: 10px 20px;
            font-size: 22px;
            color: #fff;
            margin-right: 10px;
            margin-left: -10px;
            margin-top: 4px; }

        .col-cyan .navbar .bars:hover {
            background-color: rgba(0, 0, 0, 0.08); }

        .col-teal .navbar .navbar-brand,
        .col-teal .navbar .navbar-brand:hover,
        .col-teal .navbar .navbar-brand:active,
        .col-teal .navbar .navbar-brand:focus {
            color: #fff; }

        .col-teal .navbar .nav > li > a:hover,
        .col-teal .navbar .nav > li > a:focus,
        .col-teal .navbar .nav .open > a,
        .col-teal .navbar .nav .open > a:hover,
        .col-teal .navbar .nav .open > a:focus {
            background-color: rgba(0, 0, 0, 0.05); }

        .col-teal .navbar .nav > li > a {
            color: #fff; }

        .col-teal .navbar .bars {
            float: left;
            padding: 10px 20px;
            font-size: 22px;
            color: #fff;
            margin-right: 10px;
            margin-left: -10px;
            margin-top: 4px; }

        .col-teal .navbar .bars:hover {
            background-color: rgba(0, 0, 0, 0.08); }

        .col-green .navbar .navbar-brand,
        .col-green .navbar .navbar-brand:hover,
        .col-green .navbar .navbar-brand:active,
        .col-green .navbar .navbar-brand:focus {
            color: #fff; }

        .col-green .navbar .nav > li > a:hover,
        .col-green .navbar .nav > li > a:focus,
        .col-green .navbar .nav .open > a,
        .col-green .navbar .nav .open > a:hover,
        .col-green .navbar .nav .open > a:focus {
            background-color: rgba(0, 0, 0, 0.05); }

        .col-green .navbar .nav > li > a {
            color: #fff; }

        .col-green .navbar .bars {
            float: left;
            padding: 10px 20px;
            font-size: 22px;
            color: #fff;
            margin-right: 10px;
            margin-left: -10px;
            margin-top: 4px; }

        .col-green .navbar .bars:hover {
            background-color: rgba(0, 0, 0, 0.08); }

        .col-light-green .navbar .navbar-brand,
        .col-light-green .navbar .navbar-brand:hover,
        .col-light-green .navbar .navbar-brand:active,
        .col-light-green .navbar .navbar-brand:focus {
            color: #fff; }

        .col-light-green .navbar .nav > li > a:hover,
        .col-light-green .navbar .nav > li > a:focus,
        .col-light-green .navbar .nav .open > a,
        .col-light-green .navbar .nav .open > a:hover,
        .col-light-green .navbar .nav .open > a:focus {
            background-color: rgba(0, 0, 0, 0.05); }

        .col-light-green .navbar .nav > li > a {
            color: #fff; }

        .col-light-green .navbar .bars {
            float: left;
            padding: 10px 20px;
            font-size: 22px;
            color: #fff;
            margin-right: 10px;
            margin-left: -10px;
            margin-top: 4px; }

        .col-light-green .navbar .bars:hover {
            background-color: rgba(0, 0, 0, 0.08); }

        .col-lime .navbar .navbar-brand,
        .col-lime .navbar .navbar-brand:hover,
        .col-lime .navbar .navbar-brand:active,
        .col-lime .navbar .navbar-brand:focus {
            color: #fff; }

        .col-lime .navbar .nav > li > a:hover,
        .col-lime .navbar .nav > li > a:focus,
        .col-lime .navbar .nav .open > a,
        .col-lime .navbar .nav .open > a:hover,
        .col-lime .navbar .nav .open > a:focus {
            background-color: rgba(0, 0, 0, 0.05); }

        .col-lime .navbar .nav > li > a {
            color: #fff; }

        .col-lime .navbar .bars {
            float: left;
            padding: 10px 20px;
            font-size: 22px;
            color: #fff;
            margin-right: 10px;
            margin-left: -10px;
            margin-top: 4px; }

        .col-lime .navbar .bars:hover {
            background-color: rgba(0, 0, 0, 0.08); }



    </style>
    <div class="container-fluid" >
        <div class="block-header">
            <h2>LISTE DES ADMINISTRES <span class="orange-text total-text total_count"></span></h2>
        </div>
        <!-- Color Pickers -->

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>ADVANCED FORM EXAMPLE WITH VALIDATION</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form id="wizard_with_validation " class="wizard clearfix" method="POST">
                            <h3>Account Information</h3>
                            <fieldset>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="username" required>
                                        <label class="form-label">Username*</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="password" id="password" required>
                                        <label class="form-label">Password*</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="confirm" required>
                                        <label class="form-label">Confirm Password*</label>
                                    </div>
                                </div>
                            </fieldset>

                            <h3>Profile Information</h3>
                            <fieldset>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="name" class="form-control" required>
                                        <label class="form-label">First Name*</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="surname" class="form-control" required>
                                        <label class="form-label">Last Name*</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" name="email" class="form-control" required>
                                        <label class="form-label">Email*</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="address" cols="30" rows="3" class="form-control no-resize" required></textarea>
                                        <label class="form-label">Address*</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input min="18" type="number" name="age" class="form-control" required>
                                        <label class="form-label">Age*</label>
                                    </div>
                                    <div class="help-info">The warning step will show up if age is less than 18</div>
                                </div>
                            </fieldset>

                            <h3>Terms & Conditions - Finish</h3>
                            <fieldset>
                                <input id="acceptTerms-2" name="acceptTerms" type="checkbox" required>
                                <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

    @stack('scripts')
    <script src="{{asset('js/scripts/vue@2.6.0.js')}}"></script>
    <script src="{{asset('plugins/jquery-steps/jquery.steps.js')}}"></script>
    <script src="{{asset('boostrap-table/bootstrap-table.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/locale/bootstrap-table-fr-FR.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/tableExport.js')}}" type="text/javascript"></script>
    <script src="{{asset('boostrap-table/extensions/copy-rows/bootstrap-table-copy-rows.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('boostrap-table/extensions/export/bootstrap-table-export.js')}}"
            type="text/javascript"></script>

    <script src="{{ asset('js/scripts/axios.min.js') }}"></script>
    <script src="{{ asset('js/console/administred.js') }}"></script>
    <script>

        $(function () {
            //Horizontal form basic
            $('#wizard_horizontal').steps({
                headerTag: 'h2',
                bodyTag: 'section',
                transitionEffect: 'slideLeft',
                onInit: function (event, currentIndex) {
                    setButtonWavesEffect(event);
                },
                onStepChanged: function (event, currentIndex, priorIndex) {
                    setButtonWavesEffect(event);
                }
            });

            //Vertical form basic
            $('#wizard_vertical').steps({
                headerTag: 'h2',
                bodyTag: 'section',
                transitionEffect: 'slideLeft',
                stepsOrientation: 'vertical',
                onInit: function (event, currentIndex) {
                    setButtonWavesEffect(event);
                },
                onStepChanged: function (event, currentIndex, priorIndex) {
                    setButtonWavesEffect(event);
                }
            });

            //Advanced form with validation
            var form = $('#wizard_with_validation').show();
            form.steps({
                headerTag: 'h3',
                bodyTag: 'fieldset',
                transitionEffect: 'slideLeft',
                onInit: function (event, currentIndex) {
                    $.AdminBSB.input.activate();

                    //Set tab width
                    var $tab = $(event.currentTarget).find('ul[role="tablist"] li');
                    var tabCount = $tab.length;
                    $tab.css('width', (100 / tabCount) + '%');

                    //set button waves effect
                    setButtonWavesEffect(event);
                },
                onStepChanging: function (event, currentIndex, newIndex) {
                    if (currentIndex > newIndex) { return true; }

                    if (currentIndex < newIndex) {
                        form.find('.body:eq(' + newIndex + ') label.error').remove();
                        form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
                    }

                    form.validate().settings.ignore = ':disabled,:hidden';
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex) {
                    setButtonWavesEffect(event);
                },
                onFinishing: function (event, currentIndex) {
                    form.validate().settings.ignore = ':disabled';
                    return form.valid();
                },
                onFinished: function (event, currentIndex) {
                    swal("Good job!", "Submitted!", "success");
                }
            });

            form.validate({
                highlight: function (input) {
                    $(input).parents('.form-line').addClass('error');
                },
                unhighlight: function (input) {
                    $(input).parents('.form-line').removeClass('error');
                },
                errorPlacement: function (error, element) {
                    $(element).parents('.form-group').append(error);
                },
                rules: {
                    'confirm': {
                        equalTo: '#password'
                    }
                }
            });

            $("#wizard").steps({
                // Disables the finish button (required if pagination is enabled)
                enableFinishButton: false,
                // Disables the next and previous buttons (optional)
                enablePagination: false,
                // Enables all steps from the begining
                enableAllSteps: true,
                // Removes the number from the title
                titleTemplate: "#title#"
            });

        });

        function setButtonWavesEffect(event) {
            $(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
            $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
        }
    </script>
@endsection


