#!/bin/bash

mkdir Generateur/html
rm Generateur/html/*.html
rm Generateur/html/*.css
cp Generateur/style.css Generateur/html/style.css

for code in Generateur/resultat/*; do
    codeISO=$(basename "${code}" | cut -d'/' -f2)
    docker run --rm -ti -v $(pwd)/Generateur:/work sae103-php ./templateHTML.php ${codeISO^^} > Generateur/html/${codeISO^^}.html
done