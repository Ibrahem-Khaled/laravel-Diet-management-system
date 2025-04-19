import { SVGAttributes } from 'react';

export default function AppLogoIcon(props: SVGAttributes<SVGElement>) {
    return (
        <img
            src="./assets/img/logo.jpeg"
            alt="Logo"
            style={{ width: '200px',}}
            // {...props}
        />
    );
}
