# Zizim URL Shortener

Zizim is a URL shortener, written in PHP. I've re-written the entire project, from the ground up, using OOP principles. It was the logical progression. The original version is visible [here](https://github.com/smithmr8/zizim).

The general purpose of this code, is to generate a shortened URL. You parse in a URL (and optionally an alias) and it provides you with a _shortened_ version. Similar to bit.ly and tinyurl. 

Any clicks (visits) to a Zizim URL are logged in order to provide usage statistics. As of yet, this feature is only accessible through the API. 

## URL Statistics / Tracking

I've added a very crude tracking view, primarily for my own benefit (thus the lack of visual niceties). Appending a dollar sign the end of the shortened URL will present you with the number of clicks and the time of the last click. E.g. http://ziz.im/url$

I will tidy this up, at some point. I need to spend some time working on the UI, this is just a temporary implementation. The "pretty" version will feature more useful information, presented in an aesthetically pleasing way. Making use of the few pieces of information which are collected to paint a digital picture, so to speak.

## The API

This iteration of Zizim encompasses a basic REST API, allowing the generation of shortened URL's by remote services and applications. It's not currently public, but I hope to do this in the near future. The structure of the API is already present in the code, I just need to integrate user registration to allow people to obtain the API tokens required to interact with it. 

## IP Blocking

Due to some malicious activity, an IP blocker class has been included to permit the blocking of specific IP addresses. If an IP is blocked, any of the URL's which were shortened from that IP are no longer active and cannot be used. 