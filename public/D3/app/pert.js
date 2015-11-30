loadData(
	{
		 name: 'PERT Diagram',
		 nodes: [
			{ id: 'node0', value: { label: 'Start | 0 | 0' } },
			{ id: 'node1', value: { label: '1 | 2 | 0' } },
			{ id: 'node2', value: { label: '2 | 3 | 0' } },
			{ id: 'node3', value: { label: '3 | 4 | 4' } },
			{ id: 'node4', value: { label: '4 | 4 | 4' } },
			{ id: 'node5', value: { label: '5 | 4 | 4' } },
		 ],
		 links:[
			{ u: 'node0', v: 'node1', value: { label: 'code1[2]' } },
			{ u: 'node0', v: 'node2', value: { label: 'code2[3]' } },
			{ u: 'node1', v: 'node3', value: { label: 'code4[2]' } },
			{ u: 'node2', v: 'node4', value: { label: 'code5[1]' } },
			{ u: 'node1', v: 'node5', value: { label: 'code3[2]' } },
		 ]
	}
);