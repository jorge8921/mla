#!/bin/bash
for items_id in $(curl -s "https://api.mercadolibre.com/sites/MLA/search?seller_id=179571326" | jq -c '.results[].id' | sed -e 's/"//g')
do
IFS=','
read -ra ADDR <<< "$items_id"
for i in "${ADDR[@]}"; 
do # access each element of array
    title=$(curl -s "https://api.mercadolibre.com/items/$i" | jq -c '.title')
    category_id=$(curl -s "https://api.mercadolibre.com/items/$i" | jq -c '.category_id' | sed -e 's/"//g')
    category_name=$(curl -s "https://api.mercadolibre.com/categories/$category_id" | jq -c '.name')
    echo $i" "$title" "$category_id" "$category_name
done
done
