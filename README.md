# Why is this program needed?

Toysonfire.ca lists some of their products on BestBuy.ca's website which allows more customers to view and purchase their products. 
BestBuy, however, has a requirement of some of the data being sent on the server side from toysonfire.ca. One of which, is the images 
of the products being sent over to their website must be a minimum of 500x500px in order to be posted on their website. Not all images 
on toysonfire.ca meet that dimension requirement so it is needed to create a program that resizes the images that are under 500px in width
or height before being sent to BestBuy.ca. 

# How it works
This php file processes images by acquiring their id number and checking their dimenions. If either the height, width or both are under 500px, 
then we must add a white border around the image enough so that it meets the 500x500px requirement. 
