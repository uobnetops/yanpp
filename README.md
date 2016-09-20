# yanpp
## Yet another Nagios ping plugin

This is a ping plugin for Nagios which aims to recreate some of the features of [Smokeping](http://oss.oetiker.ch/smokeping/)
inside Nagios, without needing to set up Smokeping. It is a feature improvement on Nagios's bundled `check_ping` plugin in
terms of the performance data.

### Installation

### Usage

The only mandatory parameter is `-H|--host` to provide the hostname.

```
check_yanpp -H <host> [-w <warnrta>,<warnpl>%] [-c <critrta>,<critpl>%] -n 5 -s 10
```

* `-V --version`    Print the version of the program
* `-h --help`       Print this help message
* `-w --warning`    Comma-separated warning thresholds for RTA and packet loss. Default: `100,10%`
* `-c --critical`   Comma-separated critical thresholds for RTA and packet loss. Default: `1000,50%`
* `-H --hostname`   Hostname or IP address to ping with ICMP packets
* `-n --number`     Number of ICMP packets to send. Default: `5`
* `-s --sleep`      Time to wait between pings in milliseconds. Default: `10`

### Configuration in Nagios
