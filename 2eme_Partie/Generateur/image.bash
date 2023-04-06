#!/bin/bash
rm pp/*.png
mkdir pp

for i in avatar/*.svg;
do
    j=$(basename "$i" | cut -d'.' -f1)
    magick $i -shave 45x45 -resize 200x200 -colorspace Gray pp/$j.png
done