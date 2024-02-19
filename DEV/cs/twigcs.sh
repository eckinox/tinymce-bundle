BASEDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )/../.."

if [ -d "${BASEDIR}/templates" ]; then
	# Lint templates before validating them if possible
	if [ -f "${BASEDIR}/bin/console" ]; then
		bin/console lint:twig templates
	fi

	vendor/friendsoftwig/twigcs/bin/twigcs templates
fi
