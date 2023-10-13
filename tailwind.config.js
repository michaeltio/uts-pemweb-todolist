/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './index.html',    
    './**/*.html',     
    './index.php',     
    './**/*.php',      
  ],
  theme: {
    extend: {},
    fontFamily: {
      'lato-regular': ['lato-regular', 'sans'], 
      'raleway-bold': ['raleway-bold', 'sans'], 
    },
  },
  plugins: [],
}

