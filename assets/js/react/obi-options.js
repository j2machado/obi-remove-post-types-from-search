const { render, useState, useEffect } = wp.element;

function App() {
    const [activeTab, setActiveTab] = useState('tab1');
    const [postTypes, setPostTypes] = useState([]);
    const [checkedPostTypes, setCheckedPostTypes] = useState({});

    const tabs = [
        { name: 'tab1', title: 'Public Post Types' },
        { name: 'tab2', title: 'About' },
        // Add more tabs as needed
    ];

    useEffect(() => {
        fetch(`${obiOptions.root}myplugin/v1/post-types`)
            .then(response => response.json())
            .then(data => setPostTypes(Object.keys(data)));
    }, []);
     

    const handleCheckChange = (postType) => {
        const newCheckedStatus = {...checkedPostTypes, [postType]: !checkedPostTypes[postType]};
        setCheckedPostTypes(newCheckedStatus);
        // TODO: You can also send the newCheckedStatus to your WordPress backend here to update the status there
    };

    return (
        <div>
            <header style={{ backgroundColor: '#eaeaea', width: '100%', padding: '10px 0 10px 25px' }}>
                <h1 style={{ textAlign: 'left' }}>Obi Remove Post Types from the WP Search</h1>
            </header>
            
            <div style={{ display: 'flex', justifyContent: 'left', background: 'lightblue', fontSize: '1.3em' }}>
                {tabs.map((tab) => (
                    <button 
                        key={tab.name}
                        onClick={() => setActiveTab(tab.name)}
                        style={{
                            backgroundColor: activeTab === tab.name ? '#007cba' : '#f7f7f7',
                            color: activeTab === tab.name ? 'white' : 'black',
                            border: 'none',
                            padding: '10px 20px',
                            cursor: 'pointer'
                        }}
                    >
                        {tab.title}
                    </button>
                ))}
            </div>

            <div style={{ backgroundColor: 'white', padding: '10px 0', filter: 'drop-shadow(-10px 10px 20px rgba(0,0,0,0.1))' }}>
                {activeTab === 'tab1' && (
                    <div style={{ padding: '25px 75px' }}>
                        <h2>Select or deselect a post type</h2>
                        <p>Selected items in the list will be included in the WordPres built-in search feature. The ones unchecked will be excluded.</p>
                        {postTypes.map((postType) => (
                            <label key={postType}>
                                <input
                                    type="checkbox"
                                    checked={checkedPostTypes[postType]}
                                    onChange={() => handleCheckChange(postType)}
                                />
                                {postType}
                            </label>
                        ))}
                    </div>
                )}
                {activeTab === 'tab2' && (
                    <div>
                        <h3>Tab 2 Content</h3>
                        {/* Add content for Tab 2 here */}
                    </div>
                )}
                {/* Add more tab content as needed */}
            </div>
        </div>
    );
}

render(
    <App />,
    document.getElementById("obi-remove-post-types-from-search-options")
);
