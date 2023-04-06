#!/bin/bash
mkdir Generateur/pdf
cat Generateur/region.conf | tr " " "_" > Generateur/regionUnder.conf
rm Generateur/pdf/*.pdf

for code in Generateur/html/*.html; do
    codeISO=$(basename "${code}" | cut -d'.' -f1)
    nom=$(egrep "${codeISO}" Generateur/regionUnder.conf | cut -d',' -f2)
    docker run --rm -ti -v $(pwd)/Generateur:/work  sae103-html2pdf "html2pdf html/${codeISO^^}.html pdf/${codeISO^^}-${nom}.pdf"
done