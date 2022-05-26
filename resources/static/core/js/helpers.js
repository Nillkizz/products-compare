window.trim = (str, char) => {
  let i = 0;
  let j = str.length - 1;
  while (str[i] === char) i++;
  while (str[j] === char) j--;
  return str.slice(i, j + 1);
}