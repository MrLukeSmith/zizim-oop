# Zizim URL Shortener

Zizim is a URL shortener, written in PHP. I've re-written the entire project, from the ground up, using OOP principles. It was the logical progression. The original version is visible [here](https://github.com/smithmr8/zizim).

The general purpose of this code, is to generate a shortened URL. You parse in a URL (and optionally an alias) and it provides you with a _shortened_ version. Similar to bit.ly and tinyurl. 

Any clicks (visits) to a Zizim URL are logged in order to provide usage statistics. As of yet, this feature is only accessible through the API. 

## The API

This iteration of Zizim encompasses a basic REST API, allowing the generation of shortened URL's by remote services and applications. It's not currently public, but I hope to do this in the near future. The structure of the API is already present in the code, I just need to integrate user registration to allow people to obtain the API tokens required to interact with it. 