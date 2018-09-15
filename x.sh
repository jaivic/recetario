var=$(git status --porcelain 2>&1)
echo 
for i in $var
do
    if [  $i != "M" ] && [  $i != "AM" ] && [  $i != ".gitignore" ] && [  $i != "??" ]; then
        if [ $i != ${i%%.php*} ]; then
            if [ $i == ${i%%.blade.php*} ]; then
              if [ "$1" = "true" ]; then
                PHPCBF --standard=PSR2 $i
            else
                echo "PHPCBF --standard=PSR2" $i
            fi
        fi
    fi
fi  
done