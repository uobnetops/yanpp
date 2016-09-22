Name:		check_yanpp
Version:	1.0.0
Release:	1%{?dist}
Summary:	Yet Another Nagios Ping Plugin

Group:		
License:	Apache 2.0
URL:		https://github.com/uobnetops/yanpp
Source0:	%{name}-%{version}.tar.gz

BuildRequires:	
Requires:	

%description
This is an ICMP ping plugin for Nagios which aims to recreate some of the features of Smokeping inside Nagios, without needing to set up Smokeping. It is a feature improvement on Nagios's bundled check_ping plugin in terms of the performance data and graphing.

%prep
%autosetup -n %{name}.git


%install
rm -rf $RPM_BUILD_ROOT
install -m755 $RPM_BUILD_DIR/%{name}-%{version}/check_yanpp $RPM_BUILD_ROOT/%{_libdir}/nagios/plugins/
install -m755 $RPM_BUILD_DIR/%{name}-%{version}/check_yanpp.php $RPM_BUILD_ROOT/%{_datarootdir}/nagios/html/pnp4nagios/templates/
%make_install


%files
%{_libdir}/nagios/plugins/check_yanpp
%{_datarootdir}/nagios/html/pnp4nagios/templates/check_yanpp.php
%doc



%changelog

