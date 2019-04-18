FROM ubuntu:19.04

RUN apt-get update && apt-get install -y \
    autoconf \
    bison \
    flex \
    g++ \
    gcc \
    gettext \
    git \
    lhasa \
    libgmpxx4ldbl \
    libgmp-dev \
    libmpfr6 \
    libmpfr-dev \
    libmpc3 \
    libmpc-dev \
    libncurses-dev \
    make \
    rsync \
    texinfo\
    wget \
    && rm -rf /var/lib/apt/lists/* && \
    cd /root && \
    git clone https://github.com/bebbo/amiga-gcc.git && \
    cd /root/amiga-gcc && \
    git checkout -qf 78c9283df9b3fb9b95d6159f17d349b1b8728902 && \
    mkdir -p /opt/amiga && \
    make update && \
    make all && \
    cd / && \
    rm -rf /root/amiga-gcc && \
    apt-get purge -y \
    autoconf \
    bison \
    flex \
    g++ \
    gcc \
    gettext \
    git \
    lhasa \
    libgmp-dev \
    libmpfr-dev \
    libmpc-dev \
    libncurses-dev \
    make \
    rsync \
    texinfo\
    wget \
    && apt-get -y autoremove

ENV PATH /opt/amiga/bin:$PATH

