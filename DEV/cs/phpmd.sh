addedFiles=`echo "$(git diff --diff-filter=d --cached --name-only)" | paste -s -d, /dev/stdin`

if [ -z "$addedFiles" ];
then
	vendor/phpmd/phpmd/src/bin/phpmd src text .phpmd.xml --exclude DEV/cs/*.php
else
	vendor/phpmd/phpmd/src/bin/phpmd $addedFiles text .phpmd.xml --exclude DEV/cs/*.php
fi
