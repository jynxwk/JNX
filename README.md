# JNX Backend
A PHP/JS single-page app framework with a router I made for creating websites.
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
- Clone the repository by using `git clone https://github.com/jynxwk/JNX.git`.

## Features
- Customization: JNX is very dynamic which means you can change almost anything in the config.json file to your liking in order to have a better programming experience. (For now that only includes the file names but in future, there will be much more.)
- Single-page app routing
- Coming soon...

## Planned
- Dynamic routes (for example to have /user routes)
- Database implementation
- API calls
- *Let me know what else I should add*
- Learning Node.js to develop the necessary skills to make this project reality. I'll create a new repository for that then and rename this project because I'd still like to keep it up.

## Wiki
Here is a quick explanation of how it works since I didn't create the wiki (yet).

### Creating routes
To create a route, you just create a new folder in the pages directory and create a new page in there (page.php by default but can be changed in the config.json)

### Adding Styles and Scripts
You can add styles and scripts to your pages either by adding `<style>` and `<script>` tags to your page or by creating files in same directory as your page. By default those files are "style.css" & "script.js" but you can configure the names of them in the config.json file.

## Disclaimer
This is my first attempt at creating my own framework so please don't have too high expectations.
I will probably create multiple versions. This one is made with JavaScript and PHP but in future I might try creating one with Node.js. My goal is to create a framework that's easy to learn with basic HTML, CSS and JavaScript understanding.

## FAQ
### This seems like regular html, css and js. What are the advantages?
The main advantage currently is that it turns your files into a preload single-page application. When hovering, the server grabs the location the link is redirecting to and then loads and returns the data of the files in there, and replaces the current code with it when clicked.

### Why PHP?
PHP was the first backend language I learned and I still find it to be the easiest to try and make a project like this.

### Coming soon...
