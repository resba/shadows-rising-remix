#!/bin/sh

# cvs_updatepublicfiles.sh : update current public cvs .tar.gz and .tar.bz2 tarballs after a commit
# commands based on those located in Sourceforge CVS documentation

# script checks out a copy of named module, tarball/compresses it, stores to /htdocs/cvs/, and deletes the checked out module (which is stored as directory in users home directory)


#Usage:
#    Upload to your SF home directory - usually, /groups/members/m/ma/maugrim_t_r, for example.
#    Using SSH, login into SF account - which automatically places you in home directory
#    type the command "sh cvs_updatepublicfiles.sh"
#    Wait for the script to complete it's job - typically 2-5 minutes
#    Both a gzip and bzip2 tarball of the CVS source will be created, replacing old versions.

cvs -d:pserver:anonymous@cvs1:/cvsroot/shadowsrising export -Dtomorrow shadowsrising && tar czvf /home/groups/s/sh/shadowsrising/htdocs/cvs/Shadows_Rising_RPG-CVS.tar.gz shadowsrising && tar cjvf /home/groups/s/sh/shadowsrising/htdocs/cvs/Shadows_Rising_RPG-CVS.tar.bz2 shadowsrising && rm -Rf shadowsrising