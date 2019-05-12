#!/bin/sh
# This should take a directory of pictures and modify them for you. ImageMagick is needed.
# Also a background image is need to compose the 2 pictures, preferably 250x250 or what have you
# mdawkins 11/16/2004

bgimage=bg_w.jpg
#bgimage=bg_b.jpg

# resizing originals to an appropriate size for viewing
mogrify -resize 250x250 *jpg
# some systems require this second step
for temp in $(ls *mgk);  do mv $temp `echo $temp | sed s/.mgk/.jpg/g`; done

# composing and background to the picture if it is not square
composite -gravity center *jpg $bgimage 
# some systems require this second step
for temp in $(ls *mgk);  do mv $temp `echo $temp | sed s/.mgk/.jpg/g`; done

# copying the image to another name tn for thumbnail resizing
for temp in $(ls *jpg);  do cp $temp `echo $temp | sed s/.jpg/_tn.jpg/g`; done
# resizing copy to an appropriate thumbnail size
mogrify -resize 110x110 *_tn.jpg
# some systems require this second step
for temp in $(ls *mgk);  do mv $temp `echo $temp | sed s/.mgk/.jpg/g`; done
