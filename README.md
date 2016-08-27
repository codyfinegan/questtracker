# Quest Tracker
This is the source code of a project I created years ago (around 2008/2009 I believe) for the website GaiaOnline.com.

It generates an image of a progress bar indicating how much gold (the website currency) needed to earn the item listed. This is generated using the GD library in PHP and merging two images (a progress bar and a background).

As far as I'm aware there are no instances of this code running online any more.

The code in here is very old, full of security holes and bad practices. I keep it as a reminder to myself about how I used to code and how far I've since come.

## History
The original version I had of this project is unfortunately lost forever. It generated the image on the fly (which created great stress on the server at the time, I was ignorant). The image was controlled by URL params passed in.

Afterwards, I switched to caching/writing the image out each time (which makes sense in hindsight).

Finally, I shifted to this version which allowed people to self-host images on free image hosts. The image was now controlled by a settings page, not a website.

## Live Example
Once I've got things set up (and I've patched some of the holes) I'll upload a working example of this project.

### Notes
The item image belongs to GaiaOnline.com and only used as an example of how it used to function.