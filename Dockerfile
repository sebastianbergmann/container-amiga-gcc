FROM ubuntu:18.04

RUN apt-get update && apt-get install -y \
    autoconf \
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
    make \
    rsync \
    texinfo\
    wget \
    && rm -rf /var/lib/apt/lists/* && \
    cd /root && \
    git clone https://github.com/bebbo/amiga-gcc.git && \
    cd /root/amiga-gcc && \
    git checkout -qf a921241d87dcc09748fb22d3c35acdb9f0837ccf && \
    mkdir -p /opt/amiga && \
    make update && \
    make all && \
    cd / && \
    rm -rf /root/amiga-gcc && \
    apt-get purge -y \
    autoconf \
    flex \
    g++ \
    gcc \
    gettext \
    git \
    lhasa \
    libgmp-dev \
    libmpfr-dev \
    libmpc-dev \
    make \
    rsync \
    texinfo\
    wget \
    && apt-get -y autoremove

ENV PATH /opt/amiga/bin:$PATH

