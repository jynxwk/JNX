# JNX Backend
A custom backend with a router I made for creating websites.
## Table Of Contents
- [Requirements](#requirements)
- [Setup](#setup)
- [Features](#features)
- [Planned](#planned)
- [Wiki](#wiki)
- [Disclaimer](#disclaimer)
- [FAQ](#faq)

## Requirements 
- Git
- PHP

## Setup
- Clone the repository by using `git clone https://github.com/jynxwk/backend.git`.

## Features
- Customization: JNX is very dynamic which means you can change almost anything in the config.json file to your liking in order to have a better programming experience. 
- Client-side routing & rendering
- Coming soon...

## Planned
- Dynamic routes (for example to have /user routes)
- Database implementation
- API calls

## Wiki
Here is a quick explanation of how it works since I didn't create the wiki yet.

### Creating routes
To create a route, you just create a new folder in the pages directory and create a new page in there (page.php by default but can be changed in the config.json)

### Adding Styles and Scripts
To add style and scripts to your pages, you just create a style/script file in the same directory as the page and it automatically gets added. By default those files are "style.css" & "script.js" but you can also configure the names of them in the config.json file.

## Disclaimer
This is my first attempt at creating my own backend/framework so please don't have too high expectations.
I will probably create multiple versions. This one is made with JavaScript and PHP but in future I might try creating one with NodeJS. My goal is to create a framework that's easy to learn with your basic HTML, CSS and JavaScript understanding. 

## FAQ
### This seems like regular html, css and js. What are the advantages?
The main advantage currently is that the server reads file you redirect to, returns it to the user and replaces the current code with it, making it a single-page app and doesn't require a page reload via navigation.

### Coming Soon...