export function setCookie(name, value, maxAge=0) {
  document.cookie = `${name}=${value};max-age=${maxAge};`;
}

export function getCookie(name, defaultValue=null) {
  const cookies = document.cookie.split(";");
  const row = cookies.find((row) => row.trim().startsWith(`${name}=`));
  return row?.split("=")[1] ?? defaultValue;
}
