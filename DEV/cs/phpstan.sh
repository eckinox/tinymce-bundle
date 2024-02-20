BASEDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )/../.."

# If this is not a Symfony project, auto-remove the Symfony-specific configuration
if [ ! -d "${BASEDIR}/var/cache" ] && grep -q "var/cache/" "${BASEDIR}/phpstan.neon"; then
	sed -i -e 's/var\/cache\/dev\/App_KernelDevDebugContainer.xml//g' "${BASEDIR}/phpstan.neon"
fi

# Ignore test directory if it exists
if [ -d "${BASEDIR}/tests" ]; then
	addedFiles=$(git diff --diff-filter=d --cached --name-only ":!tests")
else
	addedFiles=$(git diff --diff-filter=d --cached --name-only "${BASEDIR}")
fi

if [ -z "$addedFiles" ];
then
	php -d memory_limit=-1 vendor/bin/phpstan analyse -n
else
	php -d memory_limit=-1 vendor/bin/phpstan analyse -n $addedFiles
fi
