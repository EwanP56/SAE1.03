#!/bin/bash

mkdir Generateur/qrcode
liste=()

while read ligne; do
    premier_colonne=$(echo $ligne | cut -d',' -f1)
    liste+=($premier_colonne)
done < Generateur/region.conf

for code in "${liste[@]}"; do
    docker run --rm -ti -v $(pwd)/Generateur:/work  sae103-qrcode qrencode "https://bigbrain.biz/${code,,}" -o qrcode/"${code,,}.png"
done
rm Generateur/qrcode/code*